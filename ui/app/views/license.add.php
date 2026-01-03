<?php
/**
 * @var CHtmlPage $this
 */
$form = new CForm();
$form->setName('license_add');

$form->addItem(new CTextBox('ls_text', ''));
$form->addItem(new CTextBox('ls_year', ''));

$form->addItem(new CSubmit('save', _('Create License')));

$page = new CHtmlPage();
$page->setTitle(_('Add License'));
$page->addItem($form);
$page->show();
