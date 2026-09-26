<?php

namespace Database\Seeders;

use App\Models\CompanyUser;

trait ResolvesCompanyOwner
{
    /**
     * The company user the demo data is attached to, when a caller sets it
     * directly (tests, or a script driving the seeder).
     */
    protected ?CompanyUser $owner = null;

    /**
     * Branches hang off company_users.id, so the demo fleet has to be attached
     * to a company *user* rather than to a company row.
     *
     * Resolution order: an explicitly set owner, then SEED_COMPANY_EMAIL, then
     * the email from CompanySeeder, then whichever active company user exists.
     *
     * It is configurable on purpose: the account you sign in with is not
     * necessarily the seeded one, and data attached to the wrong user looks
     * exactly like the seeder did nothing. Set it with
     * `SEED_COMPANY_EMAIL=demo@tcar.test php artisan db:seed --class=BranchSeeder`
     * because `db:seed` accepts no options of its own.
     */
    protected function owner(): ?CompanyUser
    {
        if ($this->owner) {
            return $this->owner;
        }

        $email = env('SEED_COMPANY_EMAIL') ?: BranchSeeder::COMPANY_EMAIL;

        if (filled($email)) {
            $owner = CompanyUser::query()->where('email', $email)->first();

            if ($owner) {
                return $owner;
            }

            $this->command?->warn("No company user with email '{$email}', falling back to the first active one.");
        }

        return CompanyUser::query()
            ->where('is_active', true)
            ->orderBy('id')
            ->first();
    }

    protected function useOwner(CompanyUser $owner): void
    {
        $this->owner = $owner;
    }
}
