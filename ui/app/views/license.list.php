<?php
/**
 * @var CHtmlPage $this
 * @var array $data
 */

$form = new CForm();
$form->setName('license_list');

$view_url = (new CUrl('zabbix.php'))
    ->setArgument('action', 'license.list')
    ->getUrl();


// $add_url = (new CUrl('zabbix.php'))
//     ->setArgument('action', 'license.create') 
//     ->getUrl();
// $add_link = (new CLink(_('Add License'), $add_url))
//     ->addClass(ZBX_STYLE_BTN)
//     ->addClass('add'); 
$add_link = (new CLink(_('Add License'), '#')) 
    ->addClass(ZBX_STYLE_BTN)
    ->addClass('add');

// **Khởi tạo table trước vòng lặp**
$table = new CTableInfo();
$table->setHeader([
    make_sorting_header(_('License text'), 'ls_text', $data['sort'], $data['sortorder'], $view_url),
    make_sorting_header(_('Year'), 'ls_year', $data['sort'], $data['sortorder'], $view_url),
    make_sorting_header(_('Created at'), 'created_at', $data['sort'], $data['sortorder'], $view_url),
    make_sorting_header(_('Status'), 'status', $data['sort'], $data['sortorder'], $view_url),
    _('Actions')
]);

$table->setPageNavigation($data['paging']);

foreach ($data['licenses'] as $license) {
    // $edit_url = (new CUrl('zabbix.php'))
    //     ->setArgument('action', 'license.edit')
    //     ->setArgument('lsid', $license['lsid'])
    //     ->getUrl();
    // $edit_link = new CLink(_('Edit'), $edit_url);
    // $edit_link->addClass(ZBX_STYLE_BTN_ALT);

    // $delete_url = (new CUrl('zabbix.php'))
    //     ->setArgument('action', 'license.delete')
    //     ->setArgument('lsid', $license['lsid'])
    //     ->getUrl();
    // $delete_link = new CLink(_('Delete'), $delete_url);
    // $delete_link->addClass(ZBX_STYLE_BTN_ALT)
    //             ->addClass('js-confirm')
    //             ->setAttribute('data-confirm', _('Are you sure you want to delete this license?'));
    
    $edit_link = new CLink(_('Edit'), '#');
    $edit_link->addClass(ZBX_STYLE_BTN_ALT);

    $delete_link = new CLink(_('Delete'), '#');
    $delete_link->addClass(ZBX_STYLE_BTN_ALT);

    $actions_col = new CCol([$edit_link, NBSP(), $delete_link]);
    $actions_col->addClass(ZBX_STYLE_NOWRAP);

    // **Status dùng class màu sẵn của Zabbix**
    $status_col = new CCol($license['status']);
    $status_col->addClass($license['status'] === 'Activated' ? 'green' : 'red');

    $table->addRow([
        $license['ls_text'],
        $license['ls_year'],
        $license['created_at'],
        $status_col,
        $actions_col
    ]);
}

$form->addItem($add_link); 
$form->addItem($table);

$page = new CHtmlPage();
$page->setTitle(_('Licenses'));
$page->addItem($form);
$page->show();
