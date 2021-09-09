<?php

use humhub\modules\user\widgets\ProfileHeaderControls;
use humhub\modules\friendship\widgets\FriendshipButton;
use humhub\modules\user\widgets\ProfileEditButton;
use humhub\modules\user\widgets\ProfileHeaderCounterSet;
use humhub\modules\user\widgets\UserFollowButton;
use humhub\modules\user\models\User;
use humhub\modules\ui\icon\widgets\Icon;




/* @var $container \humhub\modules\content\components\ContentContainerActiveRecord */
$user_profile = $this->context->container->profile;

//calculate years licensed
$years_licensed = floor((strtotime("now")-strtotime($user_profile->license_date))/31556952);


?>
<div class="panel-body">
    <div class="panel-profile-controls">
        <div class="row">
            <div class="col-md-12">
            
            <?php if($user_profile->market):?>
              <?= Icon::get('map-pin')?>
              <?= $user_profile->market ?>
            <?php endif?>

            <?php if($user_profile->license_date):?>
              <strong><?= $years_licensed ?></strong> Years licensed
            <?php endif?>

                <div class="controls controls-header pull-right">
                    <?= ProfileHeaderControls::widget([
                        'user' => $container,
                        'widgets' => [
                            [ProfileEditButton::class, ['user' => $container], []],
                            [UserFollowButton::class, ['user' => $container], []],
                            [FriendshipButton::class, ['user' => $container], []],
                        ]
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div>
<?php 
// print_r($user_profile);
// $categories = $user_profile->getProfileFieldCategories();
// print_r($categories);
?>
</div>


