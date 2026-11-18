<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
 public function up(): void {
  Schema::create('admin_users',function(Blueprint $t){$t->id();$t->string('name');$t->string('email')->unique();$t->string('password');$t->timestamps();});
  Schema::create('admin_tokens',function(Blueprint $t){$t->id();$t->string('token_hash',64)->unique();$t->timestamp('expires_at')->nullable();$t->timestamps();});
  Schema::create('company_profiles',function(Blueprint $t){$t->id();$t->string('name')->default('Okins Group');$t->text('description')->nullable();$t->text('vision')->nullable();$t->string('address')->nullable();$t->string('email')->nullable();$t->string('phone',50)->nullable();$t->timestamps();});
  Schema::create('company_missions',function(Blueprint $t){$t->id();$t->text('content');$t->unsignedInteger('sort_order')->default(0);$t->timestamps();});
  Schema::create('company_divisions',function(Blueprint $t){$t->id();$t->string('name');$t->text('description');$t->unsignedInteger('sort_order')->default(0);$t->timestamps();});
  Schema::create('contact_messages',function(Blueprint $t){$t->id();$t->string('name',120);$t->string('email',180);$t->text('message');$t->timestamps();});
 }
 public function down(): void {
  Schema::dropIfExists('contact_messages');Schema::dropIfExists('company_divisions');Schema::dropIfExists('company_missions');Schema::dropIfExists('company_profiles');Schema::dropIfExists('admin_tokens');Schema::dropIfExists('admin_users');
 }
};
