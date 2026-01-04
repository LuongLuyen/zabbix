<?php
$page = new CHtmlPage();
$page->setTitle(_('Edit License'));

$form = new CForm();
$form->setName('license_edit');
$form->setAttribute('method','post');

// Hidden để biết update
$form->addItem(new CTextBox('action_type','update',true));
$form->addItem(new CTextBox('lsid',$license['lsid'],true));

// License Text
$form->addItem(new CTextBox('ls_text', $license['ls_text']));

// License Year
$year = new CTextBox('ls_year', $license['ls_year']);
$year->setAttribute('type','number');
$year->setAttribute('min',2026);
$year->setAttribute('max',2045);
$form->addItem($year);

$form->addItem(new CSubmit('save', _('Update License')));

$page->addItem($form);
$page->show();
