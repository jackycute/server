<?php
/**
 * @copyright Copyright (c) 2017 Arthur Schiwon <blizzz@arthur-schiwon.de>
 *
 * @author Arthur Schiwon <blizzz@arthur-schiwon.de>
 *
 * @license GNU AGPL version 3 or any later version
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

namespace OC\Core\Controller;

use OC\Collaboration\Collaborators\Search;
use OCP\AppFramework\Controller;
use OCP\AppFramework\Http\DataResponse;
use OCP\Collaboration\AutoComplete\IManager;
use OCP\IRequest;
use OCP\Share;

class AutoCompleteController extends Controller {
	/** @var Search */
	private $collaboratorSearch;
	/** @var IManager */
	private $autoCompleteManager;

	public function __construct($appName, IRequest $request, Search $collaboratorSearch, IManager $autoCompleteManager) {
		parent::__construct($appName, $request);

		$this->collaboratorSearch = $collaboratorSearch;
		$this->autoCompleteManager = $autoCompleteManager;
	}

	/**
	 * @NoAdminRequired
	 *
	 * @param string $itemType
	 * @param string $itemId
	 * @param string|null $sorter
	 * @param array $shareTypes
	 * @return DataResponse
	 */
	public function get($itemType, $itemId, $sorter = null, $shareTypes = [Share::SHARE_TYPE_USER]) {
		// if enumeration/user listings are disabled, we'll receive an empty
		// result from search() – thus nothing else to do here.
		list($results,) = $this->collaboratorSearch->search('', $shareTypes, false, 20, 0);

		// there won't be exact matches without a search string
		unset($results['exact']);

		$sorters = array_reverse(explode('|', $sorter));
		$this->autoCompleteManager->runSorters($sorters, $results, [
			'itemType' => $itemType,
			'itemId' => $itemId,
		]);

		return new DataResponse($results);
	}
}
