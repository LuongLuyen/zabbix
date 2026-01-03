<?php
/**
 * @var CHtmlPage $this
 * @var array $license
 */

$page = new CHtmlPage();
$page->setTitle(_('Edit License'));

$form = (new CForm())->setName('license_edit');
$formList = new CFormList();

$formList->addRow(_('License Text'), (new CTextBox('ls_text'))->setValue($license['ls_text']));
$formList->addRow(_('Year'), (new CTextBox('ls_year'))->setValue($license['ls_year']));

$form->addItem(new CHidden('lsid', $license['lsid']));
$form->addItem($formList);
$form->addItem(new CSubmitButton(_('Update')));

$page->addItem($form);
$page->show();
