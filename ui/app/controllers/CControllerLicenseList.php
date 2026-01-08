<?php declare(strict_types = 0);

require_once 'include/classes/api/API_License.php';

class CControllerLicenseList extends CController {

	protected function init(): void {
		$this->disableCsrfValidation();
	}

	protected function checkInput(): bool {
		$fields = [
			'action_type' => 'string', // list, create
			'lsid'    => 'id',
			'ls_text' => 'string',
			'ls_year' => ['type'=>'int','min'=>2026,'max'=>2045],
			'sort'      => 'in ls_text,ls_year,created_at',
			'sortorder' => 'in '.ZBX_SORT_DOWN.','.ZBX_SORT_UP,
			'page'      => 'ge 1'
		];

		$ret = $this->validateInput($fields);
		if (!$ret) {
			$this->setResponse(new CControllerResponseFatal());
		}
		return $ret;
	}

	protected function checkPermissions(): bool {
		return $this->checkAccess(CRoleHelper::UI_ADMINISTRATION_PROXIES);
	}

	protected function doAction(): void {
		$actionType = $this->getInput('action_type', 'list');

		switch ($actionType) {
			case 'create':
				$this->showAddForm();
				break;
			case 'save': 
				$this->createLicense();
				break;
			default:
				$this->listLicenses();
		}
	}

	// --- LIST LICENSES ---
	protected function listLicenses(): void {
		$sortField = $this->getInput('sort','created_at');
		$sortOrder = $this->getInput('sortorder', ZBX_SORT_UP);
		$pageNum   = $this->getInput('page',1);

		$licenses = API_License::get([
			'output' => ['lsid','ls_text','ls_year','status','created_at'],
			'limit'  => 100,
			'preservekeys' => true
		]);

		order_result($licenses, $sortField, $sortOrder);

		$paging = CPagerHelper::paginate($pageNum, $licenses, $sortOrder,
			(new CUrl('sdnet.php'))->setArgument('action', 'license.list')
		);

		$data = [
			'licenses'  => $licenses,
			'sort'      => $sortField,
			'sortorder' => $sortOrder,
			'paging'    => $paging
		];

		$this->setResponse(new CControllerResponseData($data));
	}

	// --- SHOW ADD FORM ---
	protected function showAddForm(): void {

	}
	// --- CREATE LICENSE ---
    protected function createLicense(): void {
        $data = [
            'ls_text' => $this->getInput('ls_text'),
            'ls_year' => (int)$this->getInput('ls_year')
        ];

        $lsid = API_License::create($data);

        // Redirect về danh sách License
        $url = (new CUrl('sdnet.php'))
            ->setArgument('action', 'license.list')   // ✔ đúng route
            ->setArgument('sort', 'ls_text')
            ->setArgument('sortorder', ZBX_SORT_DOWN);

        $this->setResponse(new CControllerResponseRedirect($url));
    }


}
