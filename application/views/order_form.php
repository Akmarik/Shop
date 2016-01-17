<div class="clear"></div>
<div class="wrap_content">
    <?php echo form_open('cart/order_complete'); ?>
    <h1>Оформление заказа</h1>
    <div class="registration">
        <div class="orderBlock">
            <h3>Способ получения</h3>
            <div class="radioOrder">
                <?php $data = array(
                    'name'        => 'order_delivery_type',
                    'id'          => 'order_delivery_type_pickup_point',
                    'value'       => '1',
                    'checked'     => TRUE,
                    'style'       => 'margin:10px',
                );
                echo form_radio($data).' Самовывоз'; ?>

                <?php $data = array(
                    'name'        => 'order_delivery_type',
                    'id'          => 'order_delivery_type_courier',
                    'value'       => '2',
                    'checked'     => false,
                    'style'       => 'margin:10px',
                );
                echo form_radio($data).' Доставка курьером'; ?>

            </div>

            <div class="wrapOrderPole">
                <div class="form-group">
                    <?php echo form_label('Город*:', 'country'); ?>
                    <?php echo form_input(array(
                        'name' => 'country',
                        'placeholder' => 'Укажите город',
                        'class' => 'country',
                        'id' => 'country',
                        'value' => set_value('country'),
                        'disabled' => 'disabled'
                    )); ?>
                    <?php echo form_error('country', '<div style="color: coral">', '</div>'); ?>
                </div>
            </div>

            <div class="wrapOrderPole">
                <div class="form-group">
                    <?php echo form_label('Улица*:', 'street'); ?>
                    <?php echo form_input(array(
                        'name' => 'street',
                        'placeholder' => 'Укажите улицу',
                        'class' => 'street',
                        'id' => 'street',
                        'value' => set_value('street'),
                        'disabled' => 'disabled'
                    )); ?>
                    <?php echo form_error('street', '<div style="color: coral">', '</div>'); ?>
                </div>
            </div>

            <div class="wrapOrderPole">
                <div class="form-group">
                    <?php echo form_label('Дом*:', 'build'); ?>
                    <?php echo form_input(array(
                        'name' => 'build',
                        'class' => 'build',
                        'id' => 'build',
                        'value' => set_value('build'),
                        'disabled' => 'disabled'
                    )); ?>
                    <?php echo form_error('build', '<div style="color: coral">', '</div>'); ?>
                </div>
            </div>

            <div class="wrapOrderPole">
                <div class="form-group">

                    <?php $options = array(
                        'flat'  => 'Квартира',
                        'office'    => 'Офис',
                    );
                    echo form_dropdown('flatANDoffice', $options);
                    ?>
                    <?php echo form_input(array(
                        'name' => 'flat_office',
                        'class' => 'flat_office',
                        'id' => 'flat_office',
                        'value' => set_value('flat_office'),
                        'disabled' => 'disabled'
                    )); ?>
                    <?php echo form_error('flat_office', '<div style="color: coral">', '</div>'); ?>
                </div>
            </div>


            <div class="wrapOrderPole">
                <div class="form-group">
                    <?php echo form_label('Дополнительно:', 'orderTextarea'); ?>
                    <?php echo form_textarea(array(
                        'name' => 'orderTextarea',
                        'class' => 'orderTextarea',
                        'id' => 'orderTextarea',
                        'value' => set_value('orderTextarea'),
                        'disabled' => 'disabled'
                    )); ?>
                    <?php echo form_error('orderTextarea', '<div style="color: coral">', '</div>'); ?>
                </div>
            </div>



        </div>
        <button type="submit" class="btn submitRegistr">Оформить заказ</button>
        <? echo form_close(); ?>
    </div>
</div>




