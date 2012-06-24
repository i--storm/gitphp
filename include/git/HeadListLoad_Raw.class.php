<?php
/**
 * Head list load strategy using raw objects
 *
 * @author Christopher Han <xiphux@gmail.com>
 * @copyright Copyright (c) 2012 Christopher Han
 * @package GitPHP
 * @subpackage Git
 */
class GitPHP_HeadListLoad_Raw extends GitPHP_RefListLoad_Raw implements GitPHP_HeadListLoadStrategy_Interface
{
	/**
	 * Loads the head list
	 *
	 * @param GitPHP_HeadList $headList head list
	 * @return array array of head hashes
	 */
	public function Load($headList)
	{
		return $this->GetRefs($headList, 'heads');
	}

	/** 
	 * Loads sorted heads
	 *
	 * @param GitPHP_HeadList $headList head list
	 * @param string $order list order
	 * @param integer $count number to load
	 */
	public function LoadOrdered($headList, $order, $count = 0)
	{
		if (!$headList)
			return;

		if (empty($order))
			return;

		$heads = $headList->GetHeads();

		/* TODO add different orders */
		if ($order == '-committerdate') {
			usort($heads, array('GitPHP_Head', 'CompareAge'));
		}

		if (($count > 0) && (count($heads) > $count)) {
			$heads = array_slice($heads, 0, $count);
		}

		return $heads;
	}
}