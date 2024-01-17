<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Carbon\Carbon;
    use Illuminate\Support\Facades\DB;
class DeleteInactiveUsers extends Command
{
    protected $signature = 'delete:inactive_users';
    protected $description = 'Delete inactive users based on specified conditions';



    public function handle()
    {
        $ninetyDaysAgo = now()->subMinutes(3);
    
        // Lấy danh sách người dùng thỏa mãn điều kiện
        $inactiveUsers = DB::table('users')
            ->where(function ($query) use ($ninetyDaysAgo) {
                $query->where('created_at', '<=', $ninetyDaysAgo)
                    ->orWhere(function ($query) use ($ninetyDaysAgo) {
                        $query->whereNotExists(function ($subquery) {
                            $subquery->select(DB::raw(1))
                                ->from('posts')
                                ->whereRaw('posts.user_id = users.id');
                        })
                        ->orWhereExists(function ($subquery) use ($ninetyDaysAgo) {
                            $subquery->select(DB::raw(1))
                                ->from('posts')
                                ->whereRaw('posts.user_id = users.id')
                                ->where('posts.created_at', '<=', $ninetyDaysAgo);
                        });
                    });
            })
            ->where('role', 0)
            ->get();
    
        // Xóa tài khoản
        foreach ($inactiveUsers as $user) {
            DB::table('users')->where('id', $user->id)->update(['deleted_at'=>now()]);
            $this->info('Deleted user: ' . $user->name);
        }
    
        $this->info('Inactive users deleted successfully.');
    }
    
}

