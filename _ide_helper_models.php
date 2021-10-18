<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Analysis
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Analysis newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Analysis newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Analysis query()
 * @method static \Illuminate\Database\Eloquent\Builder|Analysis whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Analysis whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Analysis whereUpdatedAt($value)
 */
	class Analysis extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Awards
 *
 * @property int $id
 * @property string $type
 * @property string|null $show_title
 * @property string|null $showing_time
 * @property string|null $show_location
 * @property string|null $photo
 * @property string|null $name
 * @property string|null $description
 * @property string|null $picture
 * @property string|null $fullname1
 * @property string|null $fullname2
 * @property string|null $image1
 * @property string|null $image2
 * @property string|null $commendation
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Awards newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Awards newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Awards query()
 * @method static \Illuminate\Database\Eloquent\Builder|Awards whereCommendation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Awards whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Awards whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Awards whereFullname1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Awards whereFullname2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Awards whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Awards whereImage1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Awards whereImage2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Awards whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Awards wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Awards wherePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Awards whereShowLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Awards whereShowTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Awards whereShowingTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Awards whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Awards whereUpdatedAt($value)
 */
	class Awards extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Booking
 *
 * @property int $id
 * @property string $user_id
 * @property string $date
 * @property string $start_time
 * @property string $end_time
 * @property string $type
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Booking newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Booking newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Booking query()
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereUserId($value)
 */
	class Booking extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Content
 *
 * @property int $id
 * @property string $title
 * @property string $start
 * @property string $end
 * @property string $genre
 * @property string $team_lead
 * @property string $delivery_date
 * @property string $country
 * @property string $location
 * @property string $status
 * @property string $distribution_platform
 * @property string $project_brief
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Content newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Content newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Content query()
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereDeliveryDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereDistributionPlatform($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereGenre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereProjectBrief($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereTeamLead($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereUserId($value)
 */
	class Content extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Country
 *
 * @property int $id
 * @property string $iso
 * @property string $name
 * @property string $nicename
 * @property string|null $iso3
 * @property int|null $numcode
 * @property int $phonecode
 * @method static \Illuminate\Database\Eloquent\Builder|Country newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Country newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Country query()
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereIso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereIso3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereNicename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereNumcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country wherePhonecode($value)
 */
	class Country extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Department
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Department newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Department newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Department query()
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereUpdatedAt($value)
 */
	class Department extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Document
 *
 * @property int $id
 * @property string $document_title
 * @property string $download_link
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Document newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Document newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Document query()
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereDocumentTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereDownloadLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereUpdatedAt($value)
 */
	class Document extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Dutylogger
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Dutylogger newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Dutylogger newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Dutylogger query()
 * @method static \Illuminate\Database\Eloquent\Builder|Dutylogger whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dutylogger whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dutylogger whereUpdatedAt($value)
 */
	class Dutylogger extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\EditorLogs
 *
 * @property int $id
 * @property int $user_id
 * @property string $first_interval
 * @property string $second_interval
 * @property string $third_interval
 * @property string $closed_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|EditorLogs newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EditorLogs newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EditorLogs query()
 * @method static \Illuminate\Database\Eloquent\Builder|EditorLogs whereClosedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EditorLogs whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EditorLogs whereFirstInterval($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EditorLogs whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EditorLogs whereSecondInterval($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EditorLogs whereThirdInterval($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EditorLogs whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EditorLogs whereUserId($value)
 */
	class EditorLogs extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Employee
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Employee newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Employee newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Employee query()
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereUpdatedAt($value)
 */
	class Employee extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\EngineerLogs
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|EngineerLogs newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EngineerLogs newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EngineerLogs query()
 * @method static \Illuminate\Database\Eloquent\Builder|EngineerLogs whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EngineerLogs whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EngineerLogs whereUpdatedAt($value)
 */
	class EngineerLogs extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Facility
 *
 * @property int $id
 * @property string $name
 * @property string $location
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Facility newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Facility newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Facility query()
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereUpdatedAt($value)
 */
	class Facility extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\McrLogs
 *
 * @property int $id
 * @property string $sto
 * @property string $timing
 * @property string $programmes
 * @property string $remarks
 * @property string $squeezbacks
 * @property string $tc
 * @property string $traffic
 * @property string $handed_over_to
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|McrLogs newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|McrLogs newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|McrLogs query()
 * @method static \Illuminate\Database\Eloquent\Builder|McrLogs whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|McrLogs whereHandedOverTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|McrLogs whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|McrLogs whereProgrammes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|McrLogs whereRemarks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|McrLogs whereSqueezbacks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|McrLogs whereSto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|McrLogs whereTc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|McrLogs whereTiming($value)
 * @method static \Illuminate\Database\Eloquent\Builder|McrLogs whereTraffic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|McrLogs whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|McrLogs whereUserId($value)
 */
	class McrLogs extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Message
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string|null $file
 * @property string|null $filename
 * @property string|null $message
 * @property string|null $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Message newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Message newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Message query()
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereUserId($value)
 */
	class Message extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OBlogs
 *
 * @property int $id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property string $event_name
 * @property string $event_date
 * @property string $location
 * @property string $producer
 * @property string $director
 * @property string $vision_mixer
 * @property string $sound
 * @property string $engineer
 * @property string $dop
 * @property string $reporter
 * @property string $digital
 * @property string $transmission_time
 * @property string $comment
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|OBlogs newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OBlogs newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OBlogs query()
 * @method static \Illuminate\Database\Eloquent\Builder|OBlogs whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OBlogs whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OBlogs whereDigital($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OBlogs whereDirector($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OBlogs whereDop($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OBlogs whereEngineer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OBlogs whereEventDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OBlogs whereEventName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OBlogs whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OBlogs whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OBlogs whereProducer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OBlogs whereReporter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OBlogs whereSound($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OBlogs whereTransmissionTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OBlogs whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OBlogs whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OBlogs whereVisionMixer($value)
 */
	class OBlogs extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProductionShowLogs
 *
 * @property int $id
 * @property string $date
 * @property string $location
 * @property string $producer1
 * @property string $producer2
 * @property string $director
 * @property string $vision_mixer
 * @property string $engineer
 * @property string $sound_technician
 * @property string $camera_operator1
 * @property string $camera_operator2
 * @property string $host
 * @property string $graphics
 * @property string $digital
 * @property string $transmission
 * @property string $transmission_time
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|ProductionShowLogs newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductionShowLogs newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductionShowLogs query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductionShowLogs whereCameraOperator1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductionShowLogs whereCameraOperator2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductionShowLogs whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductionShowLogs whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductionShowLogs whereDigital($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductionShowLogs whereDirector($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductionShowLogs whereEngineer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductionShowLogs whereGraphics($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductionShowLogs whereHost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductionShowLogs whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductionShowLogs whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductionShowLogs whereProducer1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductionShowLogs whereProducer2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductionShowLogs whereSoundTechnician($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductionShowLogs whereTransmission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductionShowLogs whereTransmissionTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductionShowLogs whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductionShowLogs whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductionShowLogs whereVisionMixer($value)
 */
	class ProductionShowLogs extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PrompterLogs
 *
 * @property int $id
 * @property string $segment
 * @property string $rundown_in
 * @property string $script_in
 * @property string $anchor
 * @property string $director
 * @property string $host
 * @property string $comment
 * @property string $graphics
 * @property string $producer
 * @property string $pa
 * @property string $engineer
 * @property string $challenges
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|PrompterLogs newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PrompterLogs newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PrompterLogs query()
 * @method static \Illuminate\Database\Eloquent\Builder|PrompterLogs whereAnchor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrompterLogs whereChallenges($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrompterLogs whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrompterLogs whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrompterLogs whereDirector($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrompterLogs whereEngineer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrompterLogs whereGraphics($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrompterLogs whereHost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrompterLogs whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrompterLogs wherePa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrompterLogs whereProducer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrompterLogs whereRundownIn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrompterLogs whereScriptIn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrompterLogs whereSegment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrompterLogs whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrompterLogs whereUserId($value)
 */
	class PrompterLogs extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Reports
 *
 * @property int $id
 * @property int $user_id
 * @property string $bulletin
 * @property string $dts_in
 * @property string $actual_in
 * @property string $variance1
 * @property string $dts_out
 * @property string $actual_out
 * @property string $variance2
 * @property string $comment
 * @property string $b2bulletin
 * @property string $b2dts_in
 * @property string $b2actual_in
 * @property string $b2variance1
 * @property string $b2dts_out
 * @property string $b2actual_out
 * @property string $b2variance2
 * @property string $b2comment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Reports newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reports newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reports query()
 * @method static \Illuminate\Database\Eloquent\Builder|Reports whereActualIn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reports whereActualOut($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reports whereB2actualIn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reports whereB2actualOut($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reports whereB2bulletin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reports whereB2comment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reports whereB2dtsIn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reports whereB2dtsOut($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reports whereB2variance1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reports whereB2variance2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reports whereBulletin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reports whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reports whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reports whereDtsIn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reports whereDtsOut($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reports whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reports whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reports whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reports whereVariance1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reports whereVariance2($value)
 */
	class Reports extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Schedule
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $start
 * @property string $end
 * @property string $allDay
 * @property string $color
 * @property string $status
 * @property string $producer1
 * @property string $producer2
 * @property string $dop1
 * @property string $dop2
 * @property string $dop3
 * @property string $dop4
 * @property string $description
 * @property string|null $video_editor
 * @property string|null $graphic_editor
 * @property string|null $digital_editor
 * @property string|null $others
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $type
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule query()
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereAllDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereDigitalEditor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereDop1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereDop2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereDop3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereDop4($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereGraphicEditor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereOthers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereProducer1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereProducer2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereVideoEditor($value)
 */
	class Schedule extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Store
 *
 * @property int $id
 * @property string $item_name
 * @property string $serial_no
 * @property string $state
 * @property string $assigned_department
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Store newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Store newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Store query()
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereAssignedDepartment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereItemName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereSerialNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereUpdatedAt($value)
 */
	class Store extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\StoreRequest
 *
 * @property int $id
 * @property string $item
 * @property string $return_date
 * @property int $user_id
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|StoreRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StoreRequest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StoreRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder|StoreRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StoreRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StoreRequest whereItem($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StoreRequest whereReturnDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StoreRequest whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StoreRequest whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StoreRequest whereUserId($value)
 */
	class StoreRequest extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Tracker
 *
 * @property int $id
 * @property int $vehicle_id
 * @property string $odometer_reading
 * @property string $refuel_date
 * @property string $fuel_added
 * @property string $fuel_cost
 * @property string|null $last_odometer_reading
 * @property string|null $kilometres
 * @property string|null $cost_per_litre
 * @property string|null $mileage
 * @property string|null $cost_per_km
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Vehicle $vehicle
 * @method static \Illuminate\Database\Eloquent\Builder|Tracker newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tracker newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tracker query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tracker whereCostPerKm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tracker whereCostPerLitre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tracker whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tracker whereFuelAdded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tracker whereFuelCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tracker whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tracker whereKilometres($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tracker whereLastOdometerReading($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tracker whereMileage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tracker whereOdometerReading($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tracker whereRefuelDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tracker whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tracker whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tracker whereVehicleId($value)
 */
	class Tracker extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TransmissionReport
 *
 * @property int $id
 * @property int $user_id
 * @property string $tc_on_duty
 * @property string $first_interval
 * @property string $second_interval
 * @property string $third_interval
 * @property string $remarks
 * @property string $closed_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|TransmissionReport newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TransmissionReport newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TransmissionReport query()
 * @method static \Illuminate\Database\Eloquent\Builder|TransmissionReport whereClosedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransmissionReport whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransmissionReport whereFirstInterval($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransmissionReport whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransmissionReport whereRemarks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransmissionReport whereSecondInterval($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransmissionReport whereTcOnDuty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransmissionReport whereThirdInterval($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransmissionReport whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransmissionReport whereUserId($value)
 */
	class TransmissionReport extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TripLogger
 *
 * @property int $id
 * @property string $number_plate
 * @property string $production_name
 * @property string $trip_date
 * @property string $assigned_driver
 * @property string $odometer_start
 * @property string $odometer_stop
 * @property string $trip_information
 * @property string $trip_distance
 * @property string $fuel_station
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|TripLogger newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TripLogger newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TripLogger query()
 * @method static \Illuminate\Database\Eloquent\Builder|TripLogger whereAssignedDriver($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TripLogger whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TripLogger whereFuelStation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TripLogger whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TripLogger whereNumberPlate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TripLogger whereOdometerStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TripLogger whereOdometerStop($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TripLogger whereProductionName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TripLogger whereTripDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TripLogger whereTripDistance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TripLogger whereTripInformation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TripLogger whereUpdatedAt($value)
 */
	class TripLogger extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $ticketit_admin
 * @property int $ticketit_agent
 * @property string $department
 * @property string $status
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OBlogs[] $ob_logs
 * @property-read int|null $ob_logs_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductionShowLogs[] $production_logs
 * @property-read int|null $production_logs_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PrompterLogs[] $prompter_logs
 * @property-read int|null $prompter_logs_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Reports[] $reports
 * @property-read int|null $reports_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\StoreRequest[] $store_request
 * @property-read int|null $store_request_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TransmissionReport[] $transmission
 * @property-read int|null $transmission_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDepartment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTicketitAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTicketitAgent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Users
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $ticketit_admin
 * @property int $ticketit_agent
 * @property string $department
 * @property string $status
 * @method static \Illuminate\Database\Eloquent\Builder|Users newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Users newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Users query()
 * @method static \Illuminate\Database\Eloquent\Builder|Users whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Users whereDepartment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Users whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Users whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Users whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Users whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Users wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Users whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Users whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Users whereTicketitAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Users whereTicketitAgent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Users whereUpdatedAt($value)
 */
	class Users extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Vehicle
 *
 * @property int $id
 * @property string $number_plate
 * @property string $vehicle_make
 * @property string $purpose
 * @property string $vehicle_colour
 * @property string $assigned_driver
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tracker[] $tracker
 * @property-read int|null $tracker_count
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle query()
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereAssignedDriver($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereNumberPlate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePurpose($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereVehicleColour($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereVehicleMake($value)
 */
	class Vehicle extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $ticketit_admin
 * @property int $ticketit_agent
 * @property string $department
 * @property string $status
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OBlogs[] $ob_logs
 * @property-read int|null $ob_logs_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductionShowLogs[] $production_logs
 * @property-read int|null $production_logs_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PrompterLogs[] $prompter_logs
 * @property-read int|null $prompter_logs_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Reports[] $reports
 * @property-read int|null $reports_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\StoreRequest[] $store_request
 * @property-read int|null $store_request_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TransmissionReport[] $transmission
 * @property-read int|null $transmission_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDepartment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTicketitAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTicketitAgent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

