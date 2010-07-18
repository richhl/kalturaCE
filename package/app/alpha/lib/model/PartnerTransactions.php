<?php

/**
 * Subclass for representing a row from the 'partner_transactions' table.
 *
 * 
 *
 * @package lib.model
 */ 
class PartnerTransactions extends BasePartnerTransactions
{
	const TRANSACTION_TYPE_DDP_SALE = 1;
	const TRANSACTION_TYPE_DDP_AUTH = 2;
	const TRANSACTION_TYPE_DDP_AUTH_CAPTURED = 3;
	const TRANSACTION_TYPE_DRT = 4;	
}
