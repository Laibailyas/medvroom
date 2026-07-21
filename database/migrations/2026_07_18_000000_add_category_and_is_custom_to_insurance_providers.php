<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('insurance_providers', function (Blueprint $table) {
            // Groups cards on the Insurance tab: Commercial, Government,
            // Medicaid Managed Care, Employer / Network, Self Pay, Other.
            if (! Schema::hasColumn('insurance_providers', 'category')) {
                $table->string('category')->default('Commercial')->after('name');
            }

            // True for providers a doctor typed in themselves via the
            // "Other" box on the Insurance tab (not in the master list).
            if (! Schema::hasColumn('insurance_providers', 'is_custom')) {
                $table->boolean('is_custom')->default(false)->after('category');
            }
        });
    }

    public function down(): void
    {
        Schema::table('insurance_providers', function (Blueprint $table) {
            $table->dropColumn(['category', 'is_custom']);
        });
    }
};
