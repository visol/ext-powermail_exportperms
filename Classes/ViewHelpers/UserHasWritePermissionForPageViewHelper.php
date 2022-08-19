<?php

namespace Visol\PowermailExportperms\ViewHelpers;

use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class UserHasWritePermissionForPageViewHelper extends AbstractViewHelper
{

    /**
     * @return bool
     */
    public function render()
    {
        $currentPageUid = (int)GeneralUtility::_GET('id');
        if (!$GLOBALS['BE_USER']->doesUserHaveAccess(BackendUtility::getRecord('pages', $currentPageUid), 16)) {
            // user does not have permission to edit contents on this page
            return false;
        }
        return true;
    }
}
