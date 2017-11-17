<?php

namespace App;

use Laravel\Socialite\Contracts\User as ProviderUser;

class SocialAccountService
{
    public function createOrGetUser(ProviderUser $providerUser, $service2)
    {
        $account = SocialAccount::whereProvider($service2)
                    ->whereProviderUserId($providerUser->getId())
                    ->first();
//dd( $account );
        if ($account) {

            return $account->user;
        }

        else

        {

            $account = new SocialAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => $service2
            ]);


            $user = User::whereEmail($providerUser->getEmail())->first();

            if (!$user) {

                $user = User::create([
                    'email' => $providerUser->getEmail(),
                    'name' => $providerUser->getName(),
                    'password' => 'nigfig',
                    'picture' => $providerUser->getAvatar()
                ]);


            }

            $account->user()->associate($user);
            $account->save();

            return $user;

        }

    }
}