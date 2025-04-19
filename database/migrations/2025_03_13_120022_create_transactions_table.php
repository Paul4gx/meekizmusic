<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
        
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('beat_id')->constrained()->onDelete('cascade'); // <-- New addition
            $table->string('reference')->unique();
            $table->string('status')->default('pending'); // pending, success, failed
            $table->unsignedBigInteger('amount');
            $table->string('currency')->default('NGN');
            $table->string('channel')->nullable();
            $table->string('gateway_response')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();
        });
        
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
}
