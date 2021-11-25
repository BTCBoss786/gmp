<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class ReportEvent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE EVENT IF NOT EXISTS report_event
            ON SCHEDULE EVERY 1 DAY
            DO
            UPDATE grievances SET status = "Reported" WHERE (status NOT IN("Resolved", "Reported")) AND (TIMESTAMPDIFF(DAY, created_at, CURRENT_TIMESTAMP) >= 2);
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP EVENT IF EXIST report_event;');
    }
}
