<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;
    protected $table = 'enrollment';
    protected $casts = [ 'department' => 'integer'];
    protected $fillable = ['id',
    'ref_no',
    'type',
    'studentno',
    'firstname',
    'middlename',
    'lastname',
    'email',
    'grade',
    'department',
    'strand',
    'courseId',
    'dob',
    'place_of_birth',
    'contactno',
    'address',
    'nationality',
    'age',
    'gender',
    'religion',
    'fathername',
    'fatherocc',
    'fathercontact',
    'fatherplace',
    'mothername',
    'motherocc',
    'mothercontact',
    'motherplace',
    'guardian_name',
    'guardian_contactno',
    'guardian_relation',
    'last_school_attended',
    'last_school_grade_level',
    'last_school_date_of_attendance',
    'last_school_address',
    'last_school_year',
    'indigenous',
    'learning_modality',
    'status',
    'validated_by',
    'approved_by',
    'cancelled_by',
    'updated_by',
    'remarks',
    'created_at',
    'school_year',
    'schoolyearfrom',
    'schoolyearto',
    'semester'];
    public $timestamps = false;
}

//these are form of University of Cebu
//elementary
// studenNo(idNo) /username
// Grade: Kinder,Nursery, 1,2,3,4,5,6
// LastName
// FirstName 
// MiddleInitial
// Suffix/Extension 
// Gender: Male,Female
// BirthDate
// BirthPlace
// Contact 
// Email
// landlineno 
// FaceBookProfileLink
// CityAddress
// CityAddressZipCode
// ProvinceAddress
// ProvinceAddressZipCode
// LRN
// NameLastSchoolAttended(for elementary)
// SchoolAddress(for elementary)
// ElementarySchoolGraduated
// ElementarySchoolGraduatedAddress
// ElemntarySchoolYearGraduated
// JuniorHighSchoolGraduated
// JuniorHighSchoolGraduatedAddress
// JuniorHighSchoolYearGraduated
// SenioHighSchoolGraduated
// SeniorHighSchoolGraduatedAddress
// SeniorHighSchoolYearGraduated
// TrackAndStrandGraduated

// SchoolYearLastAttended ex: 2019 - 2020
// School Type (Public/Private)
// MotherName 
// MotherContact
// MotherEmail
// MotherOccupation
// FatherName
// FatherContact
// FatherEmail 
// FatherOccupation
// GuardianName
// Contact 


// //college uniqueField
// CivilStatus
// CollegeSchoolGraduated(for transfere/graduated school)
// CollegeAchoolYearGraduated(yyyy)(for transfere/graduated school)
// LastSchoolSemesterAttended(for transfere/graduated school)
// ProgramOrCourse(for transfere/graduated school)
// ACRNO(forForeiner)
// Spousename(if married)
// SpouseAddress
// Spousezipcode
// SpouseProvincialAddress
// SpouseProvincialZipCode
// SuportingStudies
// CompanyName
// CompanyAddress

// Attachment:
// userId, Attachment



