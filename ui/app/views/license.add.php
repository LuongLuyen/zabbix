<?php
$page = new CHtmlPage();
$page->setTitle(_('Add License'));

$form = new CForm();
$form->setName('license_add');
$form->setAttribute('method', 'post');

// Hidden để controller biết action save
$form->addItem(new CTextBox('action_type', 'save', true));

// License Text
$form->addItem(new CTextBox('ls_text', ''));

// License Year
$year = new CTextBox('ls_year', '');
$year->setAttribute('type','number');
$year->setAttribute('min',2026);
$year->setAttribute('max',2045);
$form->addItem($year);

$form->addItem(new CSubmit('save', _('Create License')));

$page->addItem($form);
$page->show();
