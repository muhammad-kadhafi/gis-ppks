<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('data_ppks', function (Blueprint $table) {
            $table->id();
            $table->string("nama");
            $table->string("nik")->nullable();
            $table->string("tempatlahir")->nullable();
            $table->date("tanggallahir")->nullable();
            $table->tinyInteger("umur")->nullable();
            $table->enum("jeniskelamin", ["Laki-Laki", "Perempuan"]);
            $table->string("alamat")->nullable();
            $table->string("kecamatan");
            $table->foreignId("id_kriteria")->constrained("jenis")->onUpdate("cascade")->onDelete("restrict");
            $table->foreignId("id_terminasi")->nullable()->constrained("terminasis")->onUpdate("cascade")->onDelete("restrict");
            $table->text("foto");
            $table->text("langitude");
            $table->text("longatitude");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_ppks');
    }
};
