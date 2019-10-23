<div class="table">
    <div class="table-responsive">
        <table class="table table-bordered table-hover" id="tireFields">
            <thead>
            <tr style="background-color: #ECEEF1;">
                <th style="width: 15px">#</th>
                <th class="col-sm-2"><?= lang('service') ?></th>
                <th class="col-md-4"><?= lang('description') ?></th>
                <th class="col-sm-1"><?php //echo lang('unit') ?></th>
                <th class=""><?= lang('qty') ?></th>
                <th class=""><?= lang('rate') ?></th>
                <th class=""><?= lang('amount') ?></th>
                <th class=""> </th>
            </tr>
            </thead>

            <tbody>
            <?php //var_dump($this->cart->contents()); ?>
            <?php $i = 1; if (!empty($this->cart->contents())) { foreach ($this->cart->contents() as $cart) {  ?>

                <tr>
                    <td>
                        <div class="form-group form-group-bottom">
                            <?php echo $i ?>
                        </div>
                    </td>

                    <td>
                        <div class="form-group form-group-bottom p_div">
                            <select name="product"  style="width: 100%; z-index: 9999;" class="form-control select2 products"  id="<?= $cart['rowid'] ?>" onchange="get_product_id(this)">
                                <option value=""><?= lang('please_select') ?>...</option>
                                <?php if (!empty($products)): ?>
                                    <?php foreach ($products as $category => $product): ?>
                                        <optgroup label="<?= $category ?>">
                                            <?php foreach ($product as $item): ?>
                                                <option value="<?= $item->id ?>" <?= $cart['id'] == $item->id ? 'selected': '';?>><?= $item->name ?></option>
                                            <?php endforeach; ?>
                                        </optgroup>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </td>

                    <td>
                        <div class="form-group form-group-bottom">
                            <?php if(isset($cart['type']) && $cart['type']){ ?>
                                <?php echo $cart['description']?>
                            <?php } else { ?>
                                <textarea class="form-control" name="description" onblur ="updateItem(this);" style="height: 200px;"
                                          id="<?php echo 'des'.$cart['rowid'] ?>" autocomplete="off"><?php echo $cart['description']?></textarea>

                            <?php } ?>
                        </div>
                    </td>



                    <td>
                        <div class="form-group form-group-bottom">
                            <?php if (is_array($cart['units']) && count($cart['units'])): ?>
                                <select class="form-control" name="unit" id="<?php echo 'uni'.$cart['rowid'] ?>" onchange="updateItem(this)">
                                    <?php foreach ($cart['units'] as $unit): ?>
                                        <?php $selected = $cart['unit'] == $unit->id ? 'selected' : ''; ?>
                                        <option value="<?= $unit->id ?>" <?=  $selected; ?>><?= $unit->name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            <?php endif; ?>
                        </div>
                    </td>


                    <td>
                        <div class="form-group form-group-bottom">
                            <input class="form-control" type="text" name="qty" onblur ="updateItem(this);"
                                   value="<?php echo $cart['qty'] ?>" id="<?php echo 'qty'.$cart['rowid'] ?>" autocomplete="off">
                        </div>
                    </td>

                    <td>
                        <div class="form-group form-group-bottom">
                            <input class="form-control" type="text" name="price" value="<?php echo $cart['price'] ?>"
                                   onblur ="updateItem(this);" id="<?php echo 'prc'.$cart['rowid'] ?>" autocomplete="off">
                        </div>
                    </td>

                    <td>
                        <div class="form-group form-group-bottom">
                            <input class="form-control" type="text" readonly value="<?php echo $cart['subtotal'] ?>">
                        </div>
                    </td>

                    <input type="hidden" name="product_code" value="<?php echo $cart['id']  ?>" id="<?php echo 'pid'.$cart['rowid'] ?>">

                    <td>
                        <a href="javascript:void(0)" id="<?php echo $cart['rowid'] ?>" onclick="removeItem(this);"  class="remTire" style="color: red"><i class="glyphicon glyphicon-trash"></i></a>
                    </td>


                </tr>

                <?php $i++; } }?>

            <tr>
                <td>
                    <div class="form-group form-group-bottom">

                    </div>
                </td>

                <td>
                    <div class="form-group form-group-bottom p_div">
                        <select class="form-control select2 products" style="width: 100%; z-index: 9999" id="" onchange="get_product_id(this)" name="product">
                            <option value=""><?= lang('please_select') ?>...</option>
                            <?php if (!empty($products)): ?>
                                <?php foreach ($products as $category => $product): ?>
                                    <optgroup label="<?= $category ?>">
                                        <?php foreach ($product as $item): ?>
                                            <option value="<?= $item->id ?>"><?= $item->name ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </td>

                <td>
                    <div class="form-group form-group-bottom">
                        <textarea class="form-control"></textarea>
                    </div>
                </td>

                <td>
                    <div class="form-group form-group-bottom">

                    </div>
                </td>

                <td>
                    <div class="form-group form-group-bottom">
                        <input class="form-control" type="text" style="width:120px" name="qty">
                    </div>
                </td>

                <td>
                    <div class="form-group form-group-bottom">
                        <input class="form-control" type="text" style="width:120px">
                    </div>
                </td>

                <td>
                    <div class="form-group form-group-bottom">
                        <input class="form-control" type="text" readonly style="width:120px">
                    </div>
                </td>



            </tr>

            </tbody>

        </table>
    </div>

    <table class="table table-hover">
        <thead>
        <tr style="border-bottom: 1px solid #ccc;">
            <th style="width: 15px"></th>
            <th class="col-sm-2"></th>
            <th class="col-sm-5"></th>
            <th class=""></th>
            <th class=""></th>
            <th style="width: 230px"></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td colspan="5" style="text-align: right">
                <?= lang('total') ?>
            </td>

            <td style="text-align: right; padding-right: 30px">
                <?php echo $this->cart->total(); ?>
            </td>

        </tr>

        <?php $total_tax = 0.00; ?>
        <?php if (!empty($this->cart->contents())): foreach ($this->cart->contents() as $item): ?>
            <?php $total_tax += $item['tax']; ?>
        <?php endforeach; endif; ?>
        <tr>
            <td colspan="5" style="text-align: right">
                <?= lang('tax') ?>
            </td>
            <td style="text-align: right; padding-right: 30px">
                <input class="form-control text-right" value="<?= $total_tax ?>" readonly>
            </td>
        </tr>

        <tr>
            <td colspan="5" style="text-align: right">
                <?= lang('discount') ?>
            </td>

            <td style="text-align: right; padding-right: 30px">
                <input type="" class="form-control" style="text-align: right" onblur="order_discount(this)" value="<?php echo $_SESSION['discount'];?>" name="discount">
            </td>

        </tr>

        <tr>
            <td colspan="5" style="text-align: right; font-weight: bold">
                <?= lang('grand_total') ?>
            </td>

            <?php
            $gtotal = $this->cart->total();
            $discount = $_SESSION['discount'];
            $discount_amount =  $discount;
            ?>
            <td style="text-align: right; padding-right: 30px; font-weight: bold; font-size: 16px">
                <?php echo default_currency() . ' ' . $this->localization->currencyFormat($gtotal + $total_tax - $discount_amount, setting('currency_format')) ?>
            </td>

        </tr>

        </tbody>
    </table>

</div>
