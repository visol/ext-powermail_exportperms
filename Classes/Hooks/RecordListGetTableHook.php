<?php

namespace Visol\PowermailExportperms\Hooks;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Lorenz Ulrich <lorenz.ulrich@visol.ch>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/
use TYPO3\CMS\Recordlist\RecordList\DatabaseRecordList;
use TYPO3\CMS\Backend\RecordList\RecordListGetTableHookInterface;
use TYPO3\CMS\Backend\Utility\BackendUtility;

/**
 * Hook to modify the getTable query for Powermail mails and answers
 */
class RecordListGetTableHook implements RecordListGetTableHookInterface
{

    /**
     * modifies the DB list query
     *
     * @param string $table The current database table
     * @param integer $pageId The record's page ID
     * @param string $additionalWhereClause An additional WHERE clause
     * @param string $selectedFieldsList Comma separated list of selected fields
     * @param DatabaseRecordList $parentObject Parent localRecordList object
     * @return void
     */
    public function getDBlistQuery($table, $pageId, &$additionalWhereClause, &$selectedFieldsList, &$parentObject): void
    {
        if ($GLOBALS['BE_USER']->isAdmin()) {
            // early return if user is admin
            return;
        }

        if ($table === 'tx_powermail_domain_model_answer' || $table === 'tx_powermail_domain_model_mail') {
            // 16 = permission to edit content on the page
            if (!$GLOBALS['BE_USER']->doesUserHaveAccess(BackendUtility::getRecord('pages', $pageId), 16)) {
                // user does not have permission to edit contents on this page, so we add a clause not to show any records
                $additionalWhereClause = 'AND 1=2';
            }
        }
    }

}
