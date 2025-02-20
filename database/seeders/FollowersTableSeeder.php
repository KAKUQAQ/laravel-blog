<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class FollowersTableSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();

        foreach ($users->where('id', '!=', 1) as $user) {
            // 获取除了自己和 id 为 1 的其他用户集合
            $potentialFollowers = $users->whereNotIn('id', [$user->id, 1]);

            // 随机选取关注者数量（1 到剩余用户数之间）
            $followerCount = rand(1, $potentialFollowers->count());

            // 随机选取用户进行关注
            $followerIds = $potentialFollowers->random($followerCount)->pluck('id')->toArray();

            // 将选中的用户设为当前用户的关注对象
            $user->followers()->attach($followerIds);
        }
    }
}
