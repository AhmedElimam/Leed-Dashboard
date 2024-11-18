<?php
namespace App\Services;

class DashboardService
{
    public function getMonthlyReports()
    {
        return [
            ['month' => 'January', 'count' => 10],
            ['month' => 'February', 'count' => 20],
        ];
    }

    public function getResolvedReports()
    {
        return [
            ['status' => 'Resolved', 'count' => 15],
            ['status' => 'Pending', 'count' => 5],
        ];
    }
}
