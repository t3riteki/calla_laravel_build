<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule as ValidationRule;
use Illuminate\Validation\Rules\Password;

use function Termwind\ask;

class registerUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:register-user {name?} {email?} {role?} {password?} {password_confirmation?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Register a new User Account. Password Format: Min. of 8 chars, 1 uppercase, 1 number, 1 special.';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $arguments = [
            'name'=>$this->argument('name')??$this->ask('Enter Name'),
            'email'=>$this->argument('email')??$this->ask('Enter Email Address'),
            'role' => strtolower( $this->argument('role')??$this->anticipate('Enter Role: [admin, instructor, learner]',['admin', 'instructor', 'learner'])),
            'password'=>$this->argument('password')??$this->secret('Enter Password (Min. of 8 chars, 1 uppercase, 1 number, 1 special)'),
            'password_confirmation'=>$this->argument('password_confirmation')??$this->secret('Confirm Password'),
        ];

        if(!$arguments['name'] || !$arguments['email'] || !$arguments['role'] || !$arguments['password']){
            $this->error('Username, Email, Role and Password is required!');
            return self::FAILURE;
        }

        $rules = [
            'name'=>'required|unique:users,name|string|max:50',
            'email'=>'required|unique:users,email|string|email:rfc,dns',
            'role'=>[
                'required',
                ValidationRule::in(['admin','instructor','learner'])
                ],
            'password'=>[
                'required',
                'confirmed',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()],
        ];
        $validator = Validator::make($arguments, $rules);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            return self::FAILURE;
        }

        $validated = $validator->validated();

        User::create([
        'name'=>$validated['name'],
        'email'=>$validated['email'],
        'password'=>Hash::make($validated['password']),
        'role'=>$validated['role'],
        ]);

        $this->info('Successfully created '.$validated['role'].', '.$validated['name']);

        return self::SUCCESS;
    }
}
