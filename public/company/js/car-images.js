(function () {
  'use strict';

  var STORAGE_KEY = 'tcar.carImages.v1';
  var FALLBACK_IMAGE = 'img/car.png';
  var MAX_FILE_SIZE = 5 * 1024 * 1024;

  function readImages() {
    try {
      return JSON.parse(window.localStorage.getItem(STORAGE_KEY) || '{}');
    } catch (error) {
      return {};
    }
  }

  function writeImages(images) {
    window.localStorage.setItem(STORAGE_KEY, JSON.stringify(images));
  }

  function setPreview(uploader, source) {
    var preview = uploader.querySelector('[data-car-image-preview]');
    var addButton = uploader.querySelector('[data-car-image-add]');
    var editButton = uploader.querySelector('[data-car-image-edit]');
    if (preview) preview.src = source || FALLBACK_IMAGE;
    uploader.classList.toggle('has-image', Boolean(source));
    if (addButton) addButton.hidden = Boolean(source);
    if (editButton) editButton.hidden = !source;
    uploader.dataset.carImage = source || '';
  }

  function showError(uploader, message) {
    var hint = uploader.querySelector('.car-image-uploader__hint');
    if (!hint) return;
    hint.textContent = message;
    hint.classList.add('is-error');
    window.setTimeout(function () {
      hint.textContent = 'PNG أو JPG أو WEBP — بحد أقصى 5MB';
      hint.classList.remove('is-error');
    }, 3000);
  }

  function initUploader(uploader) {
    var input = uploader.querySelector('[data-car-image-input]');
    var removeButton = uploader.querySelector('[data-car-image-remove]');
    var key = uploader.dataset.carImageKey;
    if (!input || !removeButton || !key) return;

    var images = readImages();
    setPreview(uploader, images[key] || '');

    input.addEventListener('change', function () {
      var file = input.files && input.files[0];
      if (!file) return;
      if (!file.type.match(/^image\/(png|jpeg|webp)$/) || file.size > MAX_FILE_SIZE) {
        input.value = '';
        showError(uploader, 'اختر صورة PNG أو JPG أو WEBP بحجم لا يتجاوز 5MB');
        return;
      }

      var reader = new FileReader();
      reader.onload = function (event) {
        var nextImages = readImages();
        nextImages[key] = event.target.result;
        writeImages(nextImages);
        setPreview(uploader, event.target.result);
        document.dispatchEvent(new CustomEvent('carImageChanged', { detail: { key: key } }));
      };
      reader.readAsDataURL(file);
    });

    removeButton.addEventListener('click', function () {
      var nextImages = readImages();
      delete nextImages[key];
      writeImages(nextImages);
      input.value = '';
      setPreview(uploader, '');
      document.dispatchEvent(new CustomEvent('carImageChanged', { detail: { key: key } }));
    });
  }

  function getImage(key) {
    return readImages()[key] || FALLBACK_IMAGE;
  }

  function init() {
    document.querySelectorAll('[data-car-image-uploader]').forEach(initUploader);
    applySavedImagesToRows();
  }

  function applySavedImagesToRows() {
    document.querySelectorAll('[data-car-image-key]').forEach(function (element) {
      if (element.hasAttribute('data-car-image-uploader')) return;
      var image = element.querySelector('img');
      if (image) image.src = getImage(element.dataset.carImageKey);
    });
  }

  window.TCarCarImages = {
    get: getImage,
    fallback: FALLBACK_IMAGE,
    applyToRows: applySavedImagesToRows,
  };

  document.addEventListener('DOMContentLoaded', init);
})();
