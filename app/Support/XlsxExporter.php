<?php

namespace App\Support;

use RuntimeException;
use ZipArchive;

class XlsxExporter
{
    public static function build(array $headers, iterable $rows): string
    {
        $xmlHead = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>';

        $contentTypes = $xmlHead
            .'<Types xmlns="http://schemas.openxmlformats.org/package/2006/content-types">'
            .'<Default Extension="rels" ContentType="application/vnd.openxmlformats-package.relationships+xml"/>'
            .'<Default Extension="xml" ContentType="application/xml"/>'
            .'<Override PartName="/xl/workbook.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet.main+xml"/>'
            .'<Override PartName="/xl/worksheets/sheet1.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.worksheet+xml"/>'
            .'<Override PartName="/xl/styles.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.styles+xml"/>'
            .'<Override PartName="/docProps/core.xml" ContentType="application/vnd.openxmlformats-package.core-properties+xml"/>'
            .'</Types>';

        $rels = $xmlHead
            .'<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">'
            .'<Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/officeDocument" Target="xl/workbook.xml"/>'
            .'<Relationship Id="rId2" Type="http://schemas.openxmlformats.org/package/2006/relationships/metadata/core-properties" Target="docProps/core.xml"/>'
            .'</Relationships>';

        $workbook = $xmlHead
            .'<workbook xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships">'
            .'<sheets><sheet name="Branches" sheetId="1" r:id="rId1"/></sheets>'
            .'</workbook>';

        $workbookRels = $xmlHead
            .'<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">'
            .'<Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/worksheet" Target="worksheets/sheet1.xml"/>'
            .'<Relationship Id="rId2" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/styles" Target="styles.xml"/>'
            .'</Relationships>';

        $styles = $xmlHead
            .'<styleSheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main">'
            .'<fonts count="2">'
            .'<font><sz val="11"/><name val="Calibri"/></font>'
            .'<font><b/><sz val="11"/><name val="Calibri"/></font>'
            .'</fonts>'
            .'<fills count="2">'
            .'<fill><patternFill patternType="none"/></fill>'
            .'<fill><patternFill patternType="gray125"/></fill>'
            .'</fills>'
            .'<borders count="1"><border><left/><right/><top/><bottom/><diagonal/></border></borders>'
            .'<cellStyleXfs count="1"><xf numFmtId="0" fontId="0" fillId="0" borderId="0"/></cellStyleXfs>'
            .'<cellXfs count="2">'
            .'<xf numFmtId="0" fontId="0" fillId="0" borderId="0" xfId="0"/>'
            .'<xf numFmtId="0" fontId="1" fillId="0" borderId="0" xfId="0" applyFont="1"/>'
            .'</cellXfs>'
            .'<cellStyles count="1"><cellStyle name="Normal" xfId="0" builtinId="0"/></cellStyles>'
            .'</styleSheet>';

        $core = $xmlHead
            .'<cp:coreProperties xmlns:cp="http://schemas.openxmlformats.org/package/2006/metadata/core-properties"'
            .' xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:dcterms="http://purl.org/dc/terms/"'
            .' xmlns:dcmitype="http://purl.org/dc/dcmitype/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">'
            .'<dc:creator>T-Car</dc:creator>'
            .'<dcterms:created xsi:type="dcterms:W3CDTF">'.date('c').'</dcterms:created>'
            .'</cp:coreProperties>';

        $sheetData = '<row r="1">';

        foreach (array_values($headers) as $i => $header) {
            $col = self::colLetter($i + 1);
            $sheetData .= '<c r="'.$col.'1" t="inlineStr" s="1"><is><t>'.self::escape((string) $header).'</t></is></c>';
        }

        $sheetData .= '</row>';

        $rowNumber = 2;
        foreach ($rows as $row) {
            $sheetData .= '<row r="'.$rowNumber.'">';

            foreach (array_values($row) as $i => $value) {
                $col = self::colLetter($i + 1);
                $reference = $col.$rowNumber;

                if (is_numeric($value) && $value !== '' && $value !== null) {
                    $sheetData .= '<c r="'.$reference.'"><v>'.$value.'</v></c>';
                } else {
                    $sheetData .= '<c r="'.$reference.'" t="inlineStr"><is><t>'.self::escape((string) ($value ?? '')).'</t></is></c>';
                }
            }

            $sheetData .= '</row>';
            $rowNumber++;
        }

        $sheet = $xmlHead
            .'<worksheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main"><sheetData>'
            .$sheetData
            .'</sheetData></worksheet>';

        $tmp = tempnam(sys_get_temp_dir(), 'xlsx-');

        if ($tmp === false) {
            throw new RuntimeException('Unable to create a temporary file for the export.');
        }

        $zip = new ZipArchive;

        if ($zip->open($tmp, ZipArchive::OVERWRITE) !== true) {
            throw new RuntimeException('Unable to create the xlsx archive.');
        }

        $zip->addFromString('[Content_Types].xml', $contentTypes);
        $zip->addFromString('_rels/.rels', $rels);
        $zip->addFromString('docProps/core.xml', $core);
        $zip->addFromString('xl/workbook.xml', $workbook);
        $zip->addFromString('xl/_rels/workbook.xml.rels', $workbookRels);
        $zip->addFromString('xl/styles.xml', $styles);
        $zip->addFromString('xl/worksheets/sheet1.xml', $sheet);
        $zip->close();

        $binary = file_get_contents($tmp);
        unlink($tmp);

        return $binary === false ? '' : $binary;
    }

    private static function colLetter(int $index): string
    {
        $letter = '';

        while ($index > 0) {
            $modulo = ($index - 1) % 26;
            $letter = chr(65 + $modulo).$letter;
            $index = intdiv($index - 1, 26);
        }

        return $letter;
    }

    private static function escape(string $value): string
    {
        return htmlspecialchars($value, ENT_XML1 | ENT_QUOTES, 'UTF-8');
    }
}
