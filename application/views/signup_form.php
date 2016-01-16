<div class="clear"></div>
<div class="wrap_content">
    <?php echo form_open('login/create_member'); ?>
    <h1>Регистрация нового пользователя</h1>
    <div class="registration">
        <div class="registrBlock1">
            <h3>Укажите следующие данные:</h3>
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
                        <?php echo form_label('Email*:', 'email_address'); ?>
                        <?php echo form_input(array(
                            'name' => 'email_address',
                            'placeholder' => 'Укажите Ваш email',
                            'class' => 'email_address',
                            'id' => 'email_address',
                            'value' => set_value('email_address')
                        )); ?>
                        <?php echo form_error('email_address', '<div style="color: coral">', '</div>'); ?>
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
                <div class="wrapNamePolya">
                    <div class="form-group">
                        <?php echo form_label('Повторите пароль*:', 'repeatPassword'); ?>
                        <?php echo form_password(array(
                            'name' => 'repeatPassword',
                            'placeholder' => 'Укажите Ваш пароль',
                            'class' => 'repeatPassword',
                            'id' => 'repeatPassword',
                            'value' => set_value('repeatPassword')
                        )); ?>
                        <?php echo form_error('repeatPassword', '<div style="color: coral">', '</div>'); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="registrBlock2">
            <h3>Персональная информация:</h3>
            <div>
                <div class="wrapNamePolya">
                    <div class="form-group">
                        <?php echo form_label('Имя*:', 'firstname'); ?>
                        <?php echo form_input(array(
                            'name' => 'firstname',
                            'placeholder' => 'Укажите Ваше имя',
                            'class' => 'firstname',
                            'id' => 'firstname',
                            'value' => set_value('firstname')
                        )); ?>
                        <?php echo form_error('firstname', '<div style="color: coral">', '</div>'); ?>
                    </div>
                </div>
                <div class="wrapNamePolya">
                    <div class="form-group">
                        <?php echo form_label('Фамилия:', 'lastname'); ?>
                        <?php echo form_input(array(
                            'name' => 'lastname',
                            'placeholder' => 'Укажите Вашу фамилию',
                            'class' => 'lastname',
                            'id' => 'lastname',
                            'value' => set_value('lastname')
                        )); ?>
                        <?php echo form_error('lastname', '<div style="color: coral">', '</div>'); ?>
                    </div>
                </div>
                <div class="wrapNamePolya">
                    <div class="form-group">
                        <?php echo form_label('Телефон*:', 'phone'); ?>
                        <?php echo form_input(array(
                            'name' => 'phone',
                            'placeholder' => 'Укажите Ваш телефон',
                            'class' => 'phone',
                            'id' => 'phone',
                            'value' => set_value('phone')
                        )); ?>
                        <?php echo form_error('phone', '<div style="color: coral">', '</div>'); ?>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn submitRegistr">Завершить регистрацию</button>
        <? echo form_close(); ?>
    </div>
</div>




