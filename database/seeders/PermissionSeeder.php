<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('permissions')->insert([
            [
                'name' => 'Create Country',
                'slug' => 'create-country',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'View Any Country',
                'slug' => 'view-any-country',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'Update Country',
                'slug' => 'update-country',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'Delete Country',
                'slug' => 'delete-country',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'Create Role',
                'slug' => 'create-role',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'View Any Role',
                'slug' => 'view-any-role',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'Update Role',
                'slug' => 'update-role',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'Delete Role',
                'slug' => 'delete-role',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'Create JobTitle',
                'slug' => 'create-jobtitle',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'View Any JobTitle',
                'slug' => 'view-any-jobtitle',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'Update JobTitle',
                'slug' => 'update-jobtitle',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'Delete JobTitle',
                'slug' => 'delete-jobtitle',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'Create Admin',
                'slug' => 'create-admin',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'View Any Admin',
                'slug' => 'view-any-admin',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'Update Admin',
                'slug' => 'update-admin',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'Delete Admin',
                'slug' => 'delete-admin',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'Create User',
                'slug' => 'create-user',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'View Any User',
                'slug' => 'view-any-user',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'Update User',
                'slug' => 'update-user',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'Delete User',
                'slug' => 'delete-user',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'Create Recruiter',
                'slug' => 'create-recruiter',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'View Any Recruiter',
                'slug' => 'view-any-recruiter',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'Update Recruiter',
                'slug' => 'update-recruiter',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'Delete Recruiter',
                'slug' => 'delete-recruiter',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'Create Resume',
                'slug' => 'create-resume',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'View Any Resume',
                'slug' => 'view-any-resume',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'Update Resume',
                'slug' => 'update-resume',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'Delete Resume',
                'slug' => 'delete-resume',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'Create Course',
                'slug' => 'create-course',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'View Any Course',
                'slug' => 'view-any-course',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'Update Course',
                'slug' => 'update-course',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'Delete Course',
                'slug' => 'delete-course',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'Create Lesson',
                'slug' => 'create-lesson',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'View Any Lesson',
                'slug' => 'view-any-lesson',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'Update Lesson',
                'slug' => 'update-lesson',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'Delete Lesson',
                'slug' => 'delete-lesson',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'Create UserCourse',
                'slug' => 'create-usercourse',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'View Any UserCourse',
                'slug' => 'view-any-usercourse',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'Update UserCourse',
                'slug' => 'update-usercourse',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'Delete UserCourse',
                'slug' => 'delete-usercourse',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'Create SubscriptionPack',
                'slug' => 'create-subscriptionpack',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'View Any SubscriptionPack',
                'slug' => 'view-any-subscriptionpack',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'Update SubscriptionPack',
                'slug' => 'update-subscriptionpack',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'Delete SubscriptionPack',
                'slug' => 'delete-subscriptionpack',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'Create Subscription',
                'slug' => 'create-subscription',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'View Any Subscription',
                'slug' => 'view-any-subscription',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'Update Subscription',
                'slug' => 'update-subscription',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'Delete Subscription',
                'slug' => 'delete-subscription',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'Create Test',
                'slug' => 'create-test',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'View Any Test',
                'slug' => 'view-any-test',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'Update Test',
                'slug' => 'update-test',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'Delete Test',
                'slug' => 'delete-test',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'Create UserTest',
                'slug' => 'create-usertest',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'View Any UserTest',
                'slug' => 'view-any-usertest',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'Update UserTest',
                'slug' => 'update-usertest',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'Delete UserTest',
                'slug' => 'delete-usertest',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'Create Project',
                'slug' => 'create-project',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'View Any Project',
                'slug' => 'view-any-project',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'Update Project',
                'slug' => 'update-project',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'Delete Project',
                'slug' => 'delete-project',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'Create InterviewRequest',
                'slug' => 'create-interviewrequest',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'View Any InterviewRequest',
                'slug' => 'view-any-interviewrequest',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'Update InterviewRequest',
                'slug' => 'update-interviewrequest',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'Delete InterviewRequest',
                'slug' => 'delete-interviewrequest',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'Create Employee',
                'slug' => 'create-employee',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'View Any Employee',
                'slug' => 'view-any-employee',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'Update Employee',
                'slug' => 'update-employee',
                'created_at' => date('Y-m-d H:i:s')

              ],
              [
                'name' => 'Delete Employee',
                'slug' => 'delete-employee',
                'created_at' => date('Y-m-d H:i:s')

              ],
        ]);

    }
}
