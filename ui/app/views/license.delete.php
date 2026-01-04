<?php
$page = new CHtmlPage();
$page->setTitle(_('Delete License'));

$form = new CForm();
$form->setName('license_delete');
$form->setAttribute('method','post');

$form->addItem(new CTextBox('action_type','confirm_delete',true));
$form->addItem(new CTextBox('lsid',$license['lsid'],true));

$form->addItem(new CSubmit('save', _('Confirm Delete')));

$page->addItem($form);
$page->show();
