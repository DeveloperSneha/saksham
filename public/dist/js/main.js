var saksham_app = angular.module('saksham', ["ng-file-model"]);

//Fetches form data from DOM & and returns object with all fields except submit button
function getFormData(form_selector) {
    var out = {};
    var s_data = jQuery(form_selector).serializeArray();

    //transform into simple data/value object
    for (var i = 0; i < s_data.length; i++) {
        var record = s_data[i];
        out[record.name] = record.value;
    }
    return out;
}

saksham_app.controller('global_controller', function ($scope) {

});

saksham_app.controller('mentor_home_controller', function ($scope) {

});

saksham_app.controller('company_dashboard_controller', function ($scope, $http, $sce) {
    $scope.current_tab = 'placed_hsdm';

    $scope.company_post_job = function () {

        $http({
            method: 'POST',
            url: '/ajax/',
            data: jQuery.param({
                'job_role': jQuery('#job_role').val(),
                'qualification': jQuery('#qualification').val(),
                'district_id': jQuery('#district_id').val(),
                'job_description': $scope.job_description,
                'salary': $scope.salary,
                'salary_negotiable': $scope.salary_negotiable,
                'email': $scope.email,
                'contact_number': $scope.contact_number,
                'website': $scope.website,
                'company_post_job': true
            }),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}  // set the headers so angular passing info as form data (not request payload)
        }).then(success, error);

        function success(response) {

            var response_data = response.data;
            if (!response_data.result.status) {
                if (response_data.error.text) {
                    $scope.error_message = $sce.trustAsHtml(response_data.error.text);
                }
            } else {
                if (response_data.error.text) {
                    $scope.error_message = $sce.trustAsHtml(response_data.error.text);
                }
                if(response_data.data.reset_form) {

                }
                if (response_data.data.text) {
                    $scope.success_message = response_data.data.text;
                    if(response_data.data.redirect) {
                        window.location.href = response_data.data.redirect;
                    }
                }
            }
        }

        function error(response) {
        }
    }
});
saksham_app.controller('explore_course', function ($scope) {

    $scope.hsdm_popup = $scope.interested_popup = false;
    $scope.job_role = '';
    $scope.job_role_id = 0;

    $scope.enrol_course = function (click_event) {
        $scope.interested_popup = true;
        $scope.hsdm_popup = false;
        $scope.job_role_id  = click_event.currentTarget.getAttribute("data-explore_job_id");
        $scope.job_role = click_event.currentTarget.getAttribute("data-explore_job_role");
    }

    $scope.enrol_other_courses = function (click_event) {
        $scope.interested_popup = false;
        $scope.hsdm_popup = true;
    }

});

/* Logins*/
saksham_app.controller('login_controller', function ($scope, $http) {

    $scope.validate_login = function () {
        $scope.error_message = $scope.success_message = '';

        $http({
            method: 'POST',
            url: '/ajax/',
            data: jQuery.param({
                'username': $scope.login_username,
                'password': $scope.login_password,
                'login_source': $scope.login_source
            }),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}  // set the headers so angular passing info as form data (not request payload)
        }).then(success, error);
    }

    function success(response) {
        $scope.login_password = '';

        var response_data = response.data;
        if (!response_data.result.status) {
            if (response_data.error.text) {
                $scope.error_message = response_data.error.text;
            }
        } else {
            if (response_data.error.text) {
                $scope.error_message = response_data.error.text;
            }
            if (response_data.data.text) {
                $scope.login_username = '';
                $scope.success_message = response_data.data.text;
                if(response_data.data.redirect) {
                    window.location.href = response_data.data.redirect;
                }
            }
        }
    }

    function error(response) {
    }
});

saksham_app.controller('reset_password_controller', function ($scope, $http, $sce) {

    $scope.validate_reset = function () {

        $scope.error_message = $scope.success_message = '';

        if ($scope.login_password == $scope.login_confirm_password) {

            $http({
                method: 'POST',
                url: '/ajax/',
                data: jQuery.param({
                    'username': $scope.login_username,
                    'password': $scope.login_password,
                    'reset_source': $scope.reset_source
                }),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}  // set the headers so angular passing info as form data (not request payload)
            }).then(success, error);

        } else {
            $scope.error_message = 'Password and confirm password must be same';
        }

    }

    function success(response) {

        $scope.login_password = $scope.login_confirm_password = '';

        var response_data = response.data;
        if (!response_data.result.status) {
            if (response_data.error.text) {
                $scope.error_message = $sce.trustAsHtml(response_data.error.text);
            }
        } else {
            if (response_data.error.text) {
                $scope.error_message = $sce.trustAsHtml(response_data.error.text);
            }
            if (response_data.data.text) {
                $scope.login_username = '';
                $scope.success_message = $sce.trustAsHtml(response_data.data.text);
                if(response_data.data.redirect) {
                    window.location.href = response_data.data.redirect;
                }
            }
        }
    }

    function error(response) {
    }
});

function getBase64(file) {
    return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => resolve(reader.result);
        reader.onerror = error => reject(error);
    });
}

function convertToBase64(selectedFile) {
    //Read File
   // var selectedFile = document.getElementById("inputFile").files;
    //Check File is not Empty
    if (selectedFile.length > 0) {
        // Select the very first file from list
        var fileToLoad = selectedFile[0];
        // FileReader function for read the file.
        var fileReader = new FileReader();
        var base64;
        // Onload of file read the file content
        fileReader.onload = function(fileLoadedEvent) {
            base64 = fileLoadedEvent.target.result;
            // Print data in console
            console.log(base64);
        };
        // Convert data to base64

        fileReader.readAsDataURL(fileToLoad);
    }
}

saksham_app.controller('add_notification_controller', function ($scope, $http, $sce) {

    $scope.add_new_notification = function () {

        var selected_file = false;
        if($scope.notification_file !== undefined) {
            selected_file  = $scope.notification_file;
        }
        $scope.error_message = $scope.success_message = '';

        $http({
            method: 'POST',
            url: '/ajax/',
            data: jQuery.param({
                'notification_title': $scope.notification_title,
                'notification_url': $scope.notification_url ? $scope.notification_url : false,
                'notification_type': $scope.notification_type,
                'notification_file': selected_file,
                'admin_actions': true,
                'action': 'add_notification'
            }),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}  // set the headers so angular passing info as form data (not request payload)
        }).then(success, error);

    }

    function success(response) {

        var response_data = response.data;
        if (!response_data.result.status) {
            if (response_data.error.text) {
                $scope.error_message = $sce.trustAsHtml(response_data.error.text);
            }
        } else {
            if (response_data.error.text) {
                $scope.error_message = $sce.trustAsHtml(response_data.error.text);
            }
            if(response_data.data.reset_form) {
                $scope.notification_title = $scope.notification_url = "";
                $scope.notification_file = undefined;
            }
            if (response_data.data.text) {
                $scope.success_message = response_data.data.text;
                if(response_data.data.redirect) {
                    window.location.href = response_data.data.redirect;
                }
            }
        }
    }

    function error(response) {
    }
});

saksham_app.controller('admin_companies_listing', function ($scope, $http) {

    $scope.deleted = [];
    console.log($scope.deleted);

    $scope.delete_company = function (click_event) {

        $http({
            method: 'POST',
            url: '/ajax/',
            data: jQuery.param({
                'admin_actions': true,
                'action': 'delete_company',
                'company_id': click_event.currentTarget.getAttribute("data-company_id")
            }),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}  // set the headers so angular passing info as form data (not request payload)
        }).then(success, error);

    }

    function success(response) {

        var response_data = response.data;
        if (!response_data.result.status) {
            if (response_data.error.text) {
                $scope.error_message = response_data.error.text;
            }
        } else {
            if (response_data.error.text) {
                $scope.error_message = $sce.trustAsHtml(response_data.error.text);
            }
            if (response_data.data.text) {
                $scope.error_message = '';
                $scope.success_message = response_data.data.text;
                $scope.deleted[response_data.data.company_id] = true;//Hide Row
            }
        }
    }

    function error(response) {
    }
});

saksham_app.controller('admin_mentors_listing', function ($scope, $http) {

    $scope.deleted = [];

    $scope.delete_mentor = function (click_event) {

        $http({
            method: 'POST',
            url: '/ajax/',
            data: jQuery.param({
                'admin_actions': true,
                'action': 'delete_mentor',
                'mentor_id': click_event.currentTarget.getAttribute("data-mentor_id")
            }),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}  // set the headers so angular passing info as form data (not request payload)
        }).then(success, error);

    }

    function success(response) {

        var response_data = response.data;
        if (!response_data.result.status) {
            if (response_data.error.text) {
                $scope.error_message = response_data.error.text;
            }
        } else {
            if (response_data.error.text) {
                $scope.error_message = $sce.trustAsHtml(response_data.error.text);
            }
            if (response_data.data.text) {
                $scope.error_message = '';
                $scope.success_message = response_data.data.text;
                $scope.deleted[response_data.data.mentor_id] = true;//Hide Row
            }
        }
    }

    function error(response) {
    }
});

//Mentor Registration
saksham_app.controller('mentor_registration_controller', function ($scope, $http) {

    $scope.register_mentor = function () {
        $scope.error_message = $scope.success_message = '';

        if ($scope.password == $scope.confirm_password) {

            $http({
                method: 'POST',
                url: '/ajax/',
                data: jQuery.param({
                    'firstname': $scope.firstname,
                    'lastname': $scope.lastname,
                    'email': $scope.email_id,
                    'password': $scope.password,
                    'mobile': $scope.mobile,
                    'mentor_registration': true
                }),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}  // set the headers so angular passing info as form data (not request payload)
            }).then(success, error);

        } else {
            $scope.error_message = 'Password and confirm password must be same';
        }

    }

    function success(response) {

        $scope.password = $scope.confirm_password = '';

        var response_data = response.data;
        if (!response_data.result.status) {
            if (response_data.error.text) {
                $scope.error_message = response_data.error.text;
            }
        } else {
            if (response_data.error.text) {
                $scope.error_message = response_data.error.text;
            }
            if(response_data.data.reset_form) {
                $scope.firstname = $scope.lastname = $scope.mobile = $scope.email_id = "";
            }
            if (response_data.data.text) {
                $scope.success_message = response_data.data.text;
                if(response_data.data.redirect) {
                    window.location.href = response_data.data.redirect;
                }
            }
        }
    }

    function error(response) {
    }

});

//Company Registration
saksham_app.controller('company_registration_controller', function ($scope, $http) {

    $scope.register_company = function () {

        $scope.error_message = $scope.success_message = '';

        if ($scope.password == $scope.confirm_password) {

            $http({
                method: 'POST',
                url: '/ajax/',
                data: jQuery.param({
                    'company_name': $scope.company_name,
                    'name': $scope.firstname,
                    'email': $scope.email_id,
                    'password': $scope.password,
                    'mobile': $scope.mobile,
                    'company_registration': true
                }),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}  // set the headers so angular passing info as form data (not request payload)
            }).then(success, error);

        } else {
            $scope.error_message = 'Password and confirm password must be same';
        }

    }

    function success(response) {

        $scope.password = $scope.confirm_password = '';

        var response_data = response.data;
        if (!response_data.result.status) {
            if (response_data.error.text) {
                $scope.error_message = response_data.error.text;
            }
        } else {
            if (response_data.error.text) {
                $scope.error_message = response_data.error.text;
            }
            if(response_data.data.reset_form) {
                $scope.firstname = $scope.company_name = $scope.mobile = $scope.email_id = "";
            }
            if (response_data.data.text) {
                $scope.success_message = response_data.data.text;
                if(response_data.data.redirect) {
                    window.location.href = response_data.data.redirect;
                }
            }
        }
    }

    function error(response) {
    }

});

saksham_app.controller('mentor_profile_controller', function ($scope, $sce, $http) {

    $scope.profile_tab = 'basic_info';

    $scope.save_basic_details = function () {

        $http({
            method: 'POST',
            url: '/ajax/',
            data: jQuery.param({
                'firstname': $scope.first_name,
                'lastname': $scope.last_name,
                'mobile': $scope.mobile_number,
                'gender': $scope.gender,
                'mentor_profile': true,
                'basic_details': true
            }),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}  // set the headers so angular passing info as form data (not request payload)
        }).then(success, error);

    }

    $scope.save_social_details = function () {

        $http({
            method: 'POST',
            url: '/ajax/',
            data: jQuery.param({
                'personal_website': $scope.personal_website,
                'facebook_url': $scope.facebook_url,
                'linkedin_url': $scope.linkedin_url,
                'twitter_url': $scope.twitter_url,
                'mentor_profile': true,
                'social_details': true
            }),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}  // set the headers so angular passing info as form data (not request payload)
        }).then(success, error);

    }
    /*$scope.mentor_languages = function() {
        $scope.mentor_selected_languages = $scope.language;
    }*/
    $scope.save_other_details = function () {

        function convert_to_date(str) {
            var date = new Date(str),
                mnth = ("0" + (date.getMonth()+1)).slice(-2),
                day  = ("0" + date.getDate()).slice(-2);
            return [ date.getFullYear(), mnth, day ].join("-");
        }

        $http({
            method: 'POST',
            url: '/ajax/',
            data: jQuery.param({
                'mentor_selected_languages': $scope.language,
                'dob': jQuery('#dob').val() ? jQuery('#dob').val() : false,
                'mentor_graduation': jQuery('#mentor_graduation').val(),
                'mentor_headline': $scope.mentor_headline,
                'mentor_about': $scope.mentor_about,
                'mentor_profile': true,
                'other_details': true
            }),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}  // set the headers so angular passing info as form data (not request payload)
        }).then(success, error);

    }

    function success(response) {


        var response_data = response.data;
        if (!response_data.result.status) {
            if (response_data.error.text) {
                $scope.error_message = response_data.error.text;
            }
        } else {
            if (response_data.error.text) {
                $scope.error_message = $sce.trustAsHtml(response_data.error.text);
            }
            if (response_data.data.text) {
                $scope.error_message = '';
                $scope.success_message = response_data.data.text;
                if(response_data.data.redirect) {
                    window.location.href = response_data.data.redirect;
                }
            }
        }
    }

    function error(response) {
    }

});

saksham_app.controller('candidate_registration_controller', function ($scope, $http) {

    $scope.register_candidate = function () {
        $scope.error_message = $scope.success_message = '';

        if ($scope.password == $scope.confirm_password) {

            $http({
                method: 'POST',
                url: '/ajax/',
                data: jQuery.param({
                    'firstname': $scope.firstname,
                    'lastname': $scope.lastname,
                    'email': $scope.email_id,
                    'password': $scope.password,
                    'mobile': $scope.mobile,
                    'candidate_registration': true
                }),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}  // set the headers so angular passing info as form data (not request payload)
            }).then(success, error);

        } else {
            $scope.error_message = 'Password and confirm password must be same';
        }

    }

    function success(response) {

        $scope.password = $scope.confirm_password = '';

        var response_data = response.data;
        if (!response_data.result.status) {
            if (response_data.error.text) {
                $scope.error_message = response_data.error.text;
            }
        } else {
            if (response_data.error.text) {
                $scope.error_message = response_data.error.text;
            }
            if(response_data.data.reset_form) {
                $scope.firstname = $scope.lastname = $scope.mobile = $scope.email_id = "";
            }
            if (response_data.data.text) {
                $scope.success_message = response_data.data.text;
                if(response_data.data.redirect) {
                    window.location.href = response_data.data.redirect;
                }
            }
        }
    }

    function error(response) {
    }

});

saksham_app.controller('candidate_alumini_controller', function ($scope, $http, $sce) {

    $scope.candidate_alumini = function () {

        $scope.error_message = $scope.success_message = '';

            $http({
                method: 'POST',
                url: '/ajax/',
                data: jQuery.param({
                    'firstname': $scope.firstname,
                    'father_name': $scope.father_name,
                    'email_id': $scope.email_id,
                    'mobile': $scope.mobile,
                    'job_role': jQuery('#job_role').val(),
                    'passed_year': jQuery('#passed_year').val(),
                    'candidate_alumini': true
                }),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}  // set the headers so angular passing info as form data (not request payload)
            }).then(success, error);
    }

    function success(response) {

        var response_data = response.data;
        if (!response_data.result.status) {
            if (response_data.error.text) {
                $scope.error_message = $sce.trustAsHtml(response_data.error.text);
            }
        } else {
            if (response_data.error.text) {
                $scope.error_message = $sce.trustAsHtml(response_data.error.text);
            }
            if(response_data.data.reset_form) {
                $scope.firstname = $scope.father_name = $scope.email_id = $scope.mobile = "";
                jQuery('#job_role').prop('selectedIndex',0);
                jQuery('#passed_year').prop('selectedIndex',0);
            }
            if (response_data.data.text) {
                $scope.success_message = response_data.data.text;
                if(response_data.data.redirect) {
                    window.location.href = response_data.data.redirect;
                }
            }
        }
    }

    function error(response) {
    }

});

saksham_app.controller('candidate_enrolment_controller', function ($scope, $sce, $http) {

    $scope.current_tab = 'basic_info';
    $scope.completed_tabs = [];

    $scope.candidate_basic_details = function () {
         $http({
            method: 'POST',
            url: '/ajax/',
            data: jQuery.param({
                'firstname': $scope.first_name,
                'lastname': $scope.last_name,
                'father_name': $scope.father_name,
                'mother_name': $scope.mother_name,
                'mobile': $scope.mobile_number,
                 'dob': jQuery('#dob').val() ? jQuery('#dob').val() : false,
                'gender': $scope.gender,
                'password': $scope.password,
                'marital_status': $scope.marital_status,
                'disabled': $scope.disabled_status,
                'candidate_enrolment': true,
                'basic_info': true
            }),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}  // set the headers so angular passing info as form data (not request payload)
        }).then(success, error);
    }

    $scope.candidate_identity_details = function() {
        $http({
            method: 'POST',
            url: '/ajax/',
            data: jQuery.param({
                'data': getFormData('#identity_info'),
                'candidate_enrolment': true,
                'identity_info': true
            }),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}  // set the headers so angular passing info as form data (not request payload)
        }).then(success, error);
    }

    $scope.candidate_professional_details = function () {
        $http({
            method: 'POST',
            url: '/ajax/',
            data: jQuery.param({
                'data': getFormData('#professional_details'),
                'candidate_enrolment': true,
                'professional_info': true
            }),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}  // set the headers so angular passing info as form data (not request payload)
        }).then(success, error);
    }

    $scope.candidate_questionnare_details = function () {
        $http({
            method: 'POST',
            url: '/ajax/',
                data: jQuery.param({
                    'saksham_requirements_industry': $scope.saksham_requirements_industry ? $scope.saksham_requirements_industry : false,
                    'receive_training': $scope.receive_training ? $scope.receive_training : false,
                    'hsdm_in_place': $scope.hsdm_in_place ? $scope.hsdm_in_place : false,
                    'sector_id': $scope.sector_id ? $scope.sector_id : false,
                    'specialisation_reason': $scope.specialisation_reason ? $scope.specialisation_reason : false,
                    'employment_status': $scope.employment_status ? $scope.employment_status : false,
                    'employment_experience': $scope.employment_experience ? $scope.employment_experience : false,
                    'type_of_job': $scope.type_of_job ? $scope.type_of_job : false,
                    'expected_salary': $scope.expected_salary ? $scope.expected_salary : false,
                    'preferred_job_location': $scope.preferred_job_location ? $scope.preferred_job_location : false,
                    'willing_for_job_bond': $scope.willing_for_job_bond ? $scope.willing_for_job_bond : false,
                    'alerts_from_different_jobs': $scope.alerts_from_different_jobs ? $scope.alerts_from_different_jobs : false,
                    'wants_to_be_as_mentor': $scope.wants_to_be_as_mentor ? $scope.wants_to_be_as_mentor : false,
                    'candidate_enrolment': true,
                    'questionnaire': true
                }),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}  // set the headers so angular passing info as form data (not request payload)
        }).then(success, error);
    }

    function success(response) {

        var response_data = response.data;
        if (!response_data.result.status) {
            if (response_data.error.text) {
                $scope.error_message = $sce.trustAsHtml(response_data.error.text);
            }
        } else {
            if (response_data.error.text) {
                $scope.error_message = $sce.trustAsHtml(response_data.error.text);
            }

            if (response_data.data.text) {

                $scope.success_message = response_data.data.text === true ? response_data.data.text : '';
                $scope.completed_tabs.push($scope.current_tab);

                if(response_data.data.next_tab) {
                    $scope.error_message = $scope.success_message = '';
                    $scope.current_tab = response_data.data.next_tab;
                }

                if(response_data.data.redirect) {
                    window.location.href = response_data.data.redirect;
                }
            }
        }
    }

    function error(response) {
    }

});

saksham_app.controller('candidate_mentor_chat_controller', function ($scope, $sce, $http) {

    $scope.send_chat_message_text= function () {
         if($scope.chat_message) {
             $http({
                 method: 'POST',
                 url: '/ajax/',
                 data: jQuery.param({
                     'sender_id': $scope.sender_id,
                     'sender_type': $scope.sender_type,
                     'receiver_id': $scope.receiver_id,
                     'receiver_type': $scope.receiver_type,
                     'chat_source': $scope.chat_source,
                     'message': $scope.chat_message,
                     'mentor_candidate_chat': true
                 }),
                 headers: {'Content-Type': 'application/x-www-form-urlencoded'}  // set the headers so angular passing info as form data (not request payload)
             }).then(success, error);

              $scope.chat_message = '';
          }
     }

    function success(response) {
        var response_data = response.data;

        jQuery( ".chat_right .messages_section").append( '<li class="sender right">' +
                '<div class="message">' +
                    '<span class="far fa-user"></span>' +
                    '<div class="message_div">'+response_data.data.message+'</div>' +
                    '<div class="time">'+response_data.data.time+'</div>' +
                '</div>' +
            '</li>' );
    }

    function error(response) {
    }

});