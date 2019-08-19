<?php

use Illuminate\Database\Seeder;
use App\Models\Room\Room;
use App\Models\Room\RoomStatus;
use App\Models\Room\RoomTransaction;
use App\Helpers\SystemTime;
class DummyRoomTransactionSeeder extends Seeder
{
	use SystemTime;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Get All Rooms
        Room::all()
        	->each(function($room){
        		$traversedate = $this->getCurrentTime()->copy()->subMonth(2);
        		$statuses = RoomStatus::getStatuses();

        		shuffle($statuses);
        		$status = array_pop($statuses);//Pop last

        		do {
        			\factory(RoomTransaction::class)->create([
        				'room' 		 => $room->code,
        				'status' 	 => $status,
        				'created_at' => $traversedate
        			]);
        			//Add days passed
        			$traversedate->addDays(rand(4,8));
        			//add 
        			$oldstatus = $status;
        			shuffle($statuses);
        			$status = array_pop($statuses);
        			array_push($statuses, $oldstatus);

        		} while ($traversedate->lessThan($this->getCurrentTime()));
        	});
    }
}
