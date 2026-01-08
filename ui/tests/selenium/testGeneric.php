<?php
/*
** Copyright (C) 2001-2025 Zabbix SIA
**
** This program is free software: you can redistribute it and/or modify it under the terms of
** the GNU Affero General Public License as published by the Free Software Foundation, version 3.
**
** This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
** without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
** See the GNU Affero General Public License for more details.
**
** You should have received a copy of the GNU Affero General Public License along with this program.
** If not, see <https://www.gnu.org/licenses/>.
**/


require_once __DIR__.'/../include/CLegacyWebTest.php';

/**
 * @backup profiles
 */
class testGeneric extends CLegacyWebTest {

	public static function provider() {
		return [
			// monitoring
			['sdnet.php?action=dashboard.view',					'Dashboard'],

			['sdnet.php?action=web.view',					'Web monitoring'],
			['sdnet.php?action=latest.view',	'Latest data'],

			['sdnet.php?action=problem.view',	'Problems'],

			['sdnet.php?action=charts.view',		'Custom graphs'],
			['sdnet.php?action=map.view',			'Configuration of network maps'],
			['sdnet.php?action=discovery.view',	'Status of discovery'],
			['sdnet.php?action=service.list',		'Services'],

			// inventory
			['hostinventoriesoverview.php',	'Host inventory overview'],
			['hostinventories.php',			'Host inventory'],

			// reports
			['sdnet.php?action=report.status',					'System information'],
			['sdnet.php?action=availabilityreport.list',		'Availability report'],
			['sdnet.php?action=toptriggers.list',				'Top 100 triggers'],
			['sdnet.php?action=toptriggers.list&filter_severities[0]=0&filter_set=1',	'Top 100 triggers'],
			['sdnet.php?action=toptriggers.list&filter_severities[1]=1&filter_set=1',	'Top 100 triggers'],
			['sdnet.php?action=toptriggers.list&filter_severities[2]=2&filter_set=1',	'Top 100 triggers'],
			['sdnet.php?action=toptriggers.list&filter_severities[3]=3&filter_set=1',	'Top 100 triggers'],
			['sdnet.php?action=toptriggers.list&filter_severities[4]=4&filter_set=1',	'Top 100 triggers'],
			['sdnet.php?action=toptriggers.list&filter_severities[5]=5&filter_set=1',	'Top 100 triggers'],

			// configuration
			['sdnet.php?action=hostgroup.list',		'Configuration of host groups'],
			['sdnet.php?action=templategroup.list',	'Configuration of template groups'],
			['sdnet.php?action=template.list',			'Configuration of templates'],
			[self::HOST_LIST_PAGE,				'Configuration of hosts'],
			['sdnet.php?action=maintenance.list',		'Configuration of maintenance periods'],
			['httpconf.php',					'Configuration of web monitoring'],

			['sdnet.php?action=action.list&eventsource=0',	'Configuration of actions'],
			['sdnet.php?action=action.list&eventsource=1',	'Configuration of actions'],
			['sdnet.php?action=action.list&eventsource=2',	'Configuration of actions'],
			['sdnet.php?action=action.list&eventsource=3',	'Configuration of actions'],
			['sdnet.php?action=action.list&eventsource=4',	'Configuration of actions'],

			['sysmaps.php',							'Configuration of network maps'],
			['sdnet.php?action=discovery.list',	'Configuration of discovery rules'],
			['sdnet.php?action=service.list.edit',	'Services'],

			// Administration
			['sdnet.php?action=gui.edit',	'Configuration of GUI'],
			['sdnet.php?action=housekeeping.edit',		'Configuration of housekeeping'],
			['sdnet.php?action=image.list',	'Configuration of images'],
			['sdnet.php?action=iconmap.list',	'Configuration of icon mapping'],
			['sdnet.php?action=regex.list',	'Configuration of regular expressions'],
			['sdnet.php?action=macros.edit',	'Configuration of macros'],
			['sdnet.php?action=trigdisplay.edit',	'Configuration of trigger displaying options'],
			['sdnet.php?action=miscconfig.edit',	'Other configuration parameters'],

			['sdnet.php?action=proxy.list',						'Configuration of proxies'],
			['sdnet.php?action=authentication.edit',				'Configuration of authentication'],
			['sdnet.php?action=usergroup.list',					'Configuration of user groups'],
			['sdnet.php?action=user.edit',		'Configuration of users'],
			['sdnet.php?action=mediatype.list',					'Configuration of media types'],
			['sdnet.php?action=script.list',						'Configuration of scripts'],
			['sdnet.php?action=auditlog.list',					'Audit log'],
			['sdnet.php?action=actionlog.list',					'Action log'],

			['sdnet.php?action=queue.overview',			'Queue [refreshed every 30 sec.]'],
			['sdnet.php?action=queue.overview.proxy',		'Queue [refreshed every 30 sec.]'],
			['sdnet.php?action=queue.details',				'Queue [refreshed every 30 sec.]'],

			['report4.php',					'Notification report'],
			['report4.php?period=daily',		'Notification report'],
			['report4.php?period=weekly',		'Notification report'],
			['report4.php?period=monthly',		'Notification report'],
			['report4.php?period=yearly',		'Notification report'],

			// Misc
			['sdnet.php?action=search&search=server',		'Search'],
			['sdnet.php?action=userprofile.edit',			'Profile']
		];
	}

	/**
	* @dataProvider provider
	*/
	public function testGeneric_Pages($url, $title) {
		$this->zbxTestLogin($url);
		$this->zbxTestCheckTitle($title);
		$this->zbxTestCheckMandatoryStrings();
	}
}
