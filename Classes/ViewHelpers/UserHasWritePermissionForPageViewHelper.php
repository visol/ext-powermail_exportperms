<?php

namespace Visol\PowermailExportperms\ViewHelpers;

use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Http\ServerRequestFactory;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class UserHasWritePermissionForPageViewHelper extends AbstractViewHelper
{
    public function render(): bool
    {
        $request = ServerRequestFactory::fromGlobals();
        $currentPageUid = (int) ($request->getQueryParams()['id'] ?? 0);
        // 16 = permission to edit content on the page
        if (!$GLOBALS['BE_USER']->doesUserHaveAccess(BackendUtility::getRecord('pages', $currentPageUid), 16)) {
            // user does not have permission to edit contents on this page
            return false;
        }
        return true;
    }
}
