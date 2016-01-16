<div class="clear"></div>
<div class="wrap_content">
    <?php echo form_open('/registration'); ?>
    <h1>Регистрация нового пользователя</h1>
    <div class="registration">
        <div class="registrBlock1">
            <h3>Укажите следующие данные1:</h3>
            <div>
                <div class="wrapNamePolya">
                    <div class="form-group">
                        <?php echo form_label('Email*:', 'email'); ?>
                        <?php echo form_input(array(
                            'name' => 'email',
                            'placeholder' => 'Укажите Ваш email',
                            'class' => 'email',
                            'id' => 'contact-email',
                            'value' => set_value('email')
                        )); ?>
                        <?php echo form_error('email', '<div style="color: coral">', '</div>'); ?>
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
                        <?php echo form_label('Фамилия*:', 'surname'); ?>
                        <?php echo form_input(array(
                            'name' => 'surname',
                            'placeholder' => 'Укажите Вашу фамилию',
                            'class' => 'surname',
                            'id' => 'surname',
                            'value' => set_value('surname')
                        )); ?>
                        <?php echo form_error('surname', '<div style="color: coral">', '</div>'); ?>
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




