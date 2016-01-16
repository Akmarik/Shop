<div class="clear"></div>
<div class="wrap_content">
    <?php echo form_open('login/validate_credentials'); ?>
    <div class="registration">
        <div class="registrBlock1">
            <div>
                <div class="wrapNamePolya">
                    <div class="form-group">
                        <?php echo form_label('Username*:', 'username'); ?>
                        <?php echo form_input(array(
                            'name' => 'username',
                            'placeholder' => 'Укажите username',
                            'class' => 'username',
                            'id' => 'username',
                            'value' => set_value('username')
                        )); ?>
                        <?php echo form_error('username', '<div style="color: coral">', '</div>'); ?>
                    </div>
                </div>
                <div class="wrapNamePolya">
                    <div class="form-group">
                        <?php echo form_label('Пароль*:', 'password'); ?>
                        <?php echo form_password(array(
                            'name' => 'password',
                            'placeholder' => 'Укажите Ваш пароль',
                            'class' => 'password',
                            'id' => 'password',
                            'value' => set_value('password')
                        )); ?>
                        <?php echo form_error('password', '<div style="color: coral">', '</div>'); ?>
                    </div>
                </div>

            </div>
        </div>

        <button type="submit" class="btn submitRegistr enter">Войти</button>
        <div class="form-group createAcc">
            <?php echo anchor('login/signup', 'Создать аккаунт'); ?>
            <?php echo form_error('password', '<div style="color: coral">', '</div>'); ?>
        </div>
        <div class="clear"></div>
        <? echo form_close(); ?>
    </div>
</div>
</div>





