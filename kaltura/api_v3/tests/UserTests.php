<?php
require_once("KalturaBaseTest.php");

class UserTests extends KalturaBaseTest 
{
	public function setUp() 
	{
	}
	
	public function tearDown() 
	{
		// clean up all users
		$c = new Criteria();
		$c->add(kuserPeer::PARTNER_ID, $this->getPartner()->getId());
		$kusers = kuserPeer::doSelect($c);
		foreach($kusers as $kuser)
		{
			$kuser->delete();
		}
	}
	
	public function testDefaultScreenNameIsTheId() 
	{
	    $userService = $this->getServiceInitializedForAction("user", "add", null, null, $this->getAdminKs());
		
	    $user = new KalturaUser();
	    $user->id = $this->getRandomString();
		$newUser = $userService->addAction(clone $user);
		
		$this->assertEquals($user->id, $newUser->screenName);
	}
	
	public function testAdd()
	{
		$userService = $this->getServiceInitializedForAction("user", "add", null, null, $this->getAdminKs());
		
		$user = $this->prepareUser();
		$newUser = $userService->addAction(clone $user);
		
		$this->assertUser($user, $newUser);
	}
	
	public function testUpdate()
	{
		$userService = $this->getServiceInitializedForAction("user", "add", null, null, $this->getAdminKs());
		
		$user = $this->prepareUser();
		$newUser = $userService->addAction(clone $user);
		
		$user = $this->prepareUser();
		$user->id = $newUser->id;
		
		$updatedUser = $userService->updateAction($user->id, clone $user);
		
		$this->assertUser($user, $updatedUser);
		
		$this->assertNotEquals($updatedUser->screenName, $newUser->screenName);
		$this->assertNotEquals($updatedUser->fullName, $newUser->fullName);
		$this->assertNotEquals($updatedUser->email, $newUser->email);
		$this->assertNotEquals($updatedUser->dateOfBirth, $newUser->dateOfBirth);
		$this->assertNotEquals($updatedUser->description, $newUser->description);
		$this->assertNotEquals(trim($updatedUser->tags), trim($newUser->tags));
		$this->assertNotEquals($updatedUser->partnerData, $newUser->partnerData);
	}
	
	public function testUpdateId()
	{
		$userService = $this->getServiceInitializedForAction("user", "add", null, null, $this->getAdminKs());
		
		$user = $this->prepareUser();
		$oldId = $user->id;
		$userService->addAction(clone $user);
		
		$user = new KalturaUser();
		$user->id = $this->getRandomString(6);
		
		$updatedUser = $userService->updateAction($oldId, $user);
		
		$this->assertNotEquals($updatedUser->id, $oldId);
		$this->assertEquals($user->id, $updatedUser->id);
	}
	
	public function testGet()
	{
		$userService = $this->getServiceInitializedForAction("user", "add", null, null, $this->getAdminKs());
		
		$user = $this->prepareUser();
		$userService->addAction(clone $user);
		
		$getUser = $userService->getAction($user->id);
		
		$this->assertUser($user, $getUser);
	}
	
	public function testDelete()
	{
		$userService = $this->getServiceInitializedForAction("user", "add", null, null, $this->getAdminKs());
		
		$user = $this->prepareUser();
		$userService->addAction(clone $user);
		$userService->deleteAction($user->id);
		$getUser = $userService->getAction($user->id);
		
		$this->assertEquals(KalturaUserStatus::DELETED, $getUser->status);
	}
	
	public function testList()
	{
		$userService = $this->getServiceInitializedForAction("user", "list", null, null, $this->getAdminKs());

		$userIds = array();
		for($i = 0; $i < 5; $i++)
		{
			$newUser = $userService->addAction(clone $this->prepareUser());
			$userIds[$newUser->id] = null;
		}
		
		$listResult = $userService->listAction();
		$this->assertEquals(5, $listResult->totalCount);
		
		foreach($listResult->objects as $user)
		{
			$this->assertArrayHasKey($user->id, $userIds);
		}
	}
	
	private function assertUser($expectedUser, $actualUser)
	{
		$this->assertEquals($expectedUser->id, $actualUser->id);
		$this->assertEquals($expectedUser->screenName, $actualUser->screenName);
		$this->assertEquals($expectedUser->fullName, $actualUser->fullName);
		$this->assertEquals($expectedUser->email, $actualUser->email);
		$this->assertEquals($expectedUser->dateOfBirth, $actualUser->dateOfBirth);
		$this->assertEquals($expectedUser->country, $actualUser->country);
		$this->assertEquals($expectedUser->state, $actualUser->state);
		$this->assertEquals($expectedUser->city, $actualUser->city);
		$this->assertEquals($expectedUser->zip, $actualUser->zip);
		$this->assertEquals($expectedUser->thumbnailUrl, $actualUser->thumbnailUrl);
		$this->assertEquals($expectedUser->description, $actualUser->description);
		$this->assertEquals(trim($expectedUser->tags), trim($actualUser->tags));
		$this->assertEquals($expectedUser->gender, $actualUser->gender);
		$this->assertEquals($expectedUser->partnerData, $actualUser->partnerData);
	}
	
	private function prepareUser()
	{
		$user = new KalturaUser();
		$user->id = $this->getRandomString(5);
		$user->screenName = $this->getRandomString(10);
		$user->fullName = $this->getRandomString(12);
		$user->email = $this->getRandomEmail();
		$user->dateOfBirth = $this->getRandomDateAsTimeStamp(true);
		$user->country = $this->getRandomString(2);
		$user->state = $this->getRandomString(2);
		$user->state = $this->getRandomString(4);
		$user->zip = $this->getRandomString(5);
		$user->thumbnailUrl = $this->getRandomString(20);
		$user->description = $this->getRandomText(50);
		$user->tags = $this->getRandomText(5);
		$user->gender = KalturaGender::FEMALE;
		$user->partnerData = $this->getRandomText(5);
		return $user; 
	}
}
