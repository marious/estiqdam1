<div><a href="<?= site_url('menu'); ?>" class="btn btn-success"><?= lang('add_new') ?></a></div><br>
<div class="row">
    <div class="col-md-12">

        <div class="box box-info">
            <div class="box-body">


                <div class="col-md-4">

                    <fieldset style="min-height: 400px;">
                        <legend><?= lang('main_menu') ?></legend>
                        <div id="list2" class="dd myadmin-dd-empty" style="min-height:350px;">
                            <ol class="dd-list">

                                <?php if (is_array($menus) && count($menus)): ?>
                                    <?php foreach ($menus as $menu): ?>
                                        <li data-id="<?= $menu['id'] ?>" class="dd-item dd3-item">
                                            <div class="dd-handle dd3-handle"></div><div class="dd3-content"><?=$menu['menu_name']?>
                                                <span class="<?= get_icon_pull() ?>">
                              <a href="<?= site_url('menu/save/' . $menu['id']) ?>"><i class="fa fa-edit"></i></a></span>
                                            </div>
                                            <?php if (is_array($menu['childs']) && count($menu['childs'])): ?>
                                                <ol class="dd-list" style="">
                                                    <?php foreach ($menu['childs'] as $menu2): ?>
                                                        <li data-id="<?=$menu2['id']?>" class="dd-item dd3-item">
                                                            <div class="dd-handle dd3-handle"></div><div class="dd3-content"><?= $menu2['menu_name'] ?>
                                                                <span class="<?= get_icon_pull() ?>">
                              <a href="<?= site_url('menu/save/' . $menu2['id']) ?>"><i class="fa fa-edit"></i></a></span>
                                                            </div>
                                                            <?php if (is_array($menu2['childs']) && count($menu2['childs'])): ?>
                                                                <ol class="dd-list" style="">
                                                                    <?php foreach ($menu2['childs'] as $menu3): ?>
                                                                        <li data-id="<?=$menu3['id']?>" class="dd-item dd3-item">
                                                                            <div class="dd-handle dd3-handle"></div><div class="dd3-content"><?=$menu3['menu_name']?>
                                                                                <span class="<?= get_icon_pull() ?>">
                                <a href="<?= site_url('menu/save/' . $menu3['id']) ?>"><i class="fa fa-edit"></i></a>
                                </span>
                                                                            </div>
                                                                        </li>


                                                                    <?php endforeach; ?>
                                                                </ol>
                                                            <?php endif; ?>
                                                        </li>

                                                    <?php endforeach; ?>
                                                </ol>
                                            <?php endif; ?>

                                        </li>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </ol>
                        </div>

                        <form action="<?= site_url('menu/save_order') ?>" method="post">
                            <input type="hidden" name="reorder" id="reorder" value="">
                            <button type="submit" class="btn btn-primary"><?= lang('reorder') ?></button>
                        </form>
                    </fieldset>

                </div><!-- ./col-md-5 -->

                <div class="col-md-5 col-md-push-2">

                    <fieldset style="min-height: 400px;">
                        <?php $menu_lang = isset($c_menu->menu_lang) && ($c_menu->menu_lang != '') ? json_decode($c_menu->menu_lang, true) : ''; ?>



                        <legend> Create / Update</legend>

                        <form action="<?= site_url('menu/save/'.$id) ?>" method="post" class="form-horizontal">

                            <input type="hidden" name="menu_id" id="menu_id" value="">
                            <input type="hidden" name="parent_id" id="parent_id" value="">


                            <div class="form-group">
                                <label for="ipt" class=" control-label col-md-4 text-right"><?= lang('title') ?>   </label>
                                <div class="col-md-8">
                                    <input class="form-control input-sm " placeholder="" required="true" name="menu_name" type="text" value="<?= $c_menu->menu_name; ?>" autocomplete="off">
                                    <div class="input-group input-group-sm" style="margin:1px 0 !important;">
                                        <input name="language_title" type="text" class="form-control" placeholder="Arabic Title" autocomplete="off" value="<?php if (isset($menu_lang['title']) && $menu_lang['title']['id'] != '') echo $menu_lang['title']['id'] ?>">
                                        <span class="input-group-addon xlick bg-default btn-sm "></span>
                                    </div>


                                </div>
                                <?= form_error('menu_name'); ?>
                            </div>



                            <div class="form-group  " >
                                <label for="ipt" class=" control-label col-md-4 text-right"> <?= lang('status') ?>  </label>
                                <div class="col-md-8 ">
                                    <div class="">
                                        <label><input type="radio" name="active"  value="1"  class="minimal-red" <?php echo set_value('active', $c_menu->active) == '1' ? 'checked' : ''; ?>>&nbsp;
                                            <?= lang('active') ?>
                                        </label>
                                    </div>
                                    <div class="">
                                        <label><input type="radio" name="active" value="0"  class="minimal-red" <?php echo set_value('active', $c_menu->active) == '0' ? 'checked' : ''; ?>>&nbsp;
                                            <?= lang('inactive') ?>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group  int-link" >
                                <label for="ipt" class=" control-label col-md-4 text-right"> <?= lang('page') ?> </label>
                                <div class="col-md-8">
                                    <select name='page' rows='5' id='page'  style="width:100%"
                                            class='form-control input-sm'>

                                        <option value=""> -- Select Page -- </option>
                                        <?php if (is_array($pages) && count($pages)): ?>
                                            <?php foreach ($pages as $page): ?>
                                                <option value="<?=$page->id?>" <?php echo set_value('page', $c_menu->page) == $page->id ? 'selected' : ''; ?> ><?=transText($page->name, get_current_lang())?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>

                            </div>


                            <br><br>
                            <div class="form-group" >
                                <label class="col-sm-4 text-right">&nbsp;</label>
                                <div class="col-sm-8">
                                    <button type="submit" class="btn btn-primary ">  <?= lang('save') ?>  </button>

                                    <?php if ($id): ?>
                                        <button type="button" data-href="<?= site_url('menu/delete/'.$c_menu->id) ?>" class="btn btn-danger" data-toggle="modal" data-target="#confirm-delete">
                                            <?= lang('delete') ?>
                                        </button>
                                    <?php endif; ?>
                                </div>

                            </div>

                        </form>

                    </fieldset>

                </div><!-- ./col-md-7 -->



            </div>
        </div>


    </div>
</div>



<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><?= lang('delete_conf') ?></h4>
            </div>
            <div class="modal-body">
                <p><?= lang('delete_conf_msg') ?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= lang('cancel') ?></button>
                <a class="btn btn-danger btn-ok"><?= lang('delete') ?></a>
            </div>
        </div>
    </div>
</div>