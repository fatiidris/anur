<div class="container-fluid">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      @php
       $AllChatUserCount = App\Models\ChatModel::getAllChatUserCount()
      @endphp
      <li class="nav-item">
        <a class="nav-link" href="{{ url('chat')}}">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">{{ !empty($AllChatUserCount) ? $AllChatUserCount : '' }}</span>
        </a>
       
      </li>
 
    </ul>
  </nav>
  <!-- /.navbar -->

  
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="javascript:;" class="brand-link" style="text-align: center;">
   @if(!empty($getHeaderSetting->getLogo()))
      <img src="{{ $getHeaderSetting->getLogo() }}" style="width: 70px; height: 70px; object-fit: contain; margin-bottom: 10px; border-radius:50%;">
   @else
      <span class="brand-text font-weight-light" style="font-weight: bold !important;font-size: 20px">School</span>
   @endif
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img style="height: 40px;width: 40px;" src="{{ Auth::user()->getProfileDirect() }}" class="img-circle elevation-2" alt="{{ Auth::user()->name }}">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          @if(Auth::user()->user_type == 1)          <li class="nav-item">
            <a href="{{ url ('admin/dashboard')}}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                dashboard 
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url ('admin/admin/list') }}" class="nav-link @if(Request::segment(2) == 'admin') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
                Admin
              </p>
            </a>
            </li>

            <li class="nav-item">
            <a href="{{ url ('admin/teacher/list') }}" class="nav-link @if(Request::segment(2) == 'teacher') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
              Teacher
              </p>
            </a>
            </li>

            <li class="nav-item">
            <a href="{{ url ('admin/student/list') }}" class="nav-link @if(Request::segment(2) == 'student') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
              Student
              </p>
            </a>
            </li>

            <li class="nav-item">
            <a href="{{ url ('admin/parent/list') }}" class="nav-link @if(Request::segment(2) == 'parent') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
              Parent
              </p>
            </a>
            </li>

            <li class="nav-item  @if(Request::segment(2) == 'class' || Request::segment(2) == 'subject' || Request::segment(2) == 'assign_subject' || Request::segment(2) == 'assign_class_teacher' || Request::segment(2) == 'class_timetable')  menu-is-opening menu-open  @endif">
            <a href="#" class="nav-link @if(Request::segment(2) == 'class'  || Request::segment(2) == 'subject' || Request::segment(2) == 'assign_subject' || Request::segment(2) == 'assign_class_teacher' || Request::segment(2) == 'class_timetable')  active  @endif">
              <i class="nav-icon fas fa-table"></i>
              <p>
               Academics
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url ('admin/class/list') }}" class="nav-link @if(Request::segment(2) == 'class') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Class</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url ('admin/subject/list') }}" class="nav-link @if(Request::segment(2) == 'subject') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Subject</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url ('admin/assign_subject/list') }}" class="nav-link  @if(Request::segment(2) == 'assign_subject') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Assign Subject</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ url ('admin/class_timetable/list') }}" class="nav-link  @if(Request::segment(2) == 'class_timetable') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Class Timetable</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ url ('admin/assign_class_teacher/list') }}" class="nav-link  @if(Request::segment(2) == 'assign_class_teacher') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Assign Class Teacher</p>
                </a>
               </li>

                <li class="nav-item">
                <a href="{{ url ('admin/assign_subject_teacher/list') }}" class="nav-link  @if(Request::segment(2) == 'assign_subject_teacher') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Assign Subject Teacher</p>
                </a>
               </li>
            </ul>
          </li>
    

         
           <li class="nav-item  @if(Request::segment(2) == 'fees_collection')  menu-is-opening menu-open  @endif">
            <a href="#" class="nav-link @if(Request::segment(2) == 'fees_collection')  active  @endif">
              <i class="nav-icon fas fa-table"></i>
              <p>
               Fees Collection
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url ('admin/fees_collection/collect_fees') }}" class="nav-link @if(Request::segment(3) == 'collect_fees') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Collect Fees</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url ('admin/fees_collection/collect_fees_report') }}" class="nav-link @if(Request::segment(3) == 'collect_fees_report') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Collect Fees Report</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item  @if(Request::segment(2) == 'examinations')  menu-is-opening menu-open  @endif">
            <a href="#" class="nav-link @if(Request::segment(2) == 'examinations')  active  @endif">
              <i class="nav-icon fas fa-table"></i>
              <p>
               Examinations
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url ('admin/examinations/session/list') }}" class="nav-link @if(Request::segment(3) == 'session') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Session</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url ('admin/examinations/term/list') }}" class="nav-link @if(Request::segment(3) == 'term') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Term</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url ('admin/examinations/exam/list') }}" class="nav-link @if(Request::segment(3) == 'exam') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Exam</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url ('admin/examinations/exam_schedule') }}" class="nav-link  @if(Request::segment(3) == 'exam_schedule') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Exam Schedule</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url ('admin/examinations/marks_register') }}" class="nav-link  @if(Request::segment(3) == 'marks_register') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Marks Register</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ url ('admin/examinations/marks_grade') }}" class="nav-link  @if(Request::segment(3) == 'marks_grade') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Marks Grades</p>
                </a>
              </li>
            </ul>
          </li>
      
          <li class="nav-item  @if(Request::segment(2) == 'attendance')  menu-is-opening menu-open  @endif">
            <a href="#" class="nav-link @if(Request::segment(2) == 'attendance')  active  @endif">
              <i class="nav-icon fas fa-table"></i>
              <p>
               Attendance
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url ('admin/attendance/student') }}" class="nav-link @if(Request::segment(3) == 'student') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Student Attendance</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ url ('admin/attendance/report') }}" class="nav-link @if(Request::segment(3) == 'report') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Attendance Report</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item  @if(Request::segment(2) == 'communicate')  menu-is-opening menu-open  @endif">
            <a href="#" class="nav-link @if(Request::segment(2) == 'communicate')  active  @endif">
              <i class="nav-icon fas fa-table"></i>
              <p>
               Communicate
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url ('admin/communicate/notice_board') }}" class="nav-link @if(Request::segment(3) == 'notice_board') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Notice Board</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url ('admin/communicate/send_email') }}" class="nav-link @if(Request::segment(3) == 'send_email') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sent Email</p>
                </a>
              </li>
            </ul>
          </li>


          <li class="nav-item  @if(Request::segment(2) == 'homework')  menu-is-opening menu-open  @endif">
            <a href="#" class="nav-link @if(Request::segment(2) == 'homework')  active  @endif">
              <i class="nav-icon fas fa-table"></i>
              <p>
               HomeWork
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url ('admin/homework/homework') }}" class="nav-link @if(Request::segment(3) == 'homework') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Homework</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url ('admin/homework/homework_report') }}" class="nav-link @if(Request::segment(3) == 'homework_report') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Homework Report</p>
                </a>
              </li>
              </ul>
          </li>

         <li class="nav-item">
            <a href="{{ url ('admin/account') }}" class="nav-link @if(Request::segment(2) == 'account') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
                My Account
              </p>
            </a>
         </li>

         <li class="nav-item  @if(Request::segment(2) == 'setting')  menu-is-opening menu-open  @endif">
            <a href="#" class="nav-link @if(Request::segment(2) == 'setting')  active  @endif">
              <i class="nav-icon fas fa-table"></i>
              <p>
               Settings
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                  <a href="{{ url ('admin/setting') }}" class="nav-link @if(Request::segment(2) == 'setting') active @endif">
                    <i class="nav-icon far fa-user"></i>
                    <p>
                      Setting
                    </p>
                  </a>
              </li>

              <li class="nav-item">
                <a href="{{ url ('admin/frontend-settings') }}" class="nav-link @if(Request::segment(2) == 'frontend-settings') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>FrontEnd Setting</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url ('admin/frontend/updates-setting') }}" class="nav-link @if(Request::segment(2) == 'frontend-settings') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Update Settings</p>
                </a>
              </li>
            </ul>
          </li>


            <li class="nav-item">
            <a href="{{ url ('admin/change_password') }}" class="nav-link @if(Request::segment(2) == 'change_password') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
               Change Password
              </p>
            </a>
            </li>

          @elseif(Auth::user()->user_type == 2)
          
          <li class="nav-item">
            <a href="{{ url ('teacher/dashboard')}}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                dashboard
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url ('teacher/my_student')}}" class="nav-link @if(Request::segment(2) == 'my_student') active @endif">
            <i class="nav-icon far fa-user"></i>
              <p>
                My Student
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url ('teacher/my_class_subject')}}" class="nav-link @if(Request::segment(2) == 'my_class_subject') active @endif">
            <i class="nav-icon far fa-user"></i>
              <p>
                My Class & Subject
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url ('teacher/my_exam_timetable') }}" class="nav-link @if(Request::segment(2) == 'my_exam_timetable') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
                My Exam Timetable
              </p>
            </a>
            </li>

            <li class="nav-item">
            <a href="{{ url ('teacher/my_calender') }}" class="nav-link @if(Request::segment(2) == 'my_calender') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
                My Calender
              </p>
            </a>
            </li>

            <li class="nav-item">
            <a href="{{ url ('teacher/marks_register') }}" class="nav-link @if(Request::segment(2) == 'marks_register') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
              Marks Register
              </p>
            </a>
            </li>

             <li class="nav-item">
            <a href="{{ url ('teacher/my_subject_marks')}}" class="nav-link @if(Request::segment(2) == 'my_subject') active @endif">
            <i class="nav-icon far fa-user"></i>
              <p>
                My Subject Mark
              </p>
            </a>
          </li>

             <li class="nav-item">
            <a href="{{ url ('teacher/remarks_report') }}" class="nav-link @if(Request::segment(2) == 'remarks_report') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
              Skilles and Behaviour
              </p>
            </a>
            </li>
            
            <li class="nav-item  @if(Request::segment(2) == 'attendance')  menu-is-opening menu-open  @endif">
            <a href="#" class="nav-link @if(Request::segment(2) == 'attendance')  active  @endif">
              <i class="nav-icon fas fa-table"></i>
              <p>
               Attendance
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url ('teacher/attendance/student') }}" class="nav-link @if(Request::segment(3) == 'student') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Student Attendance</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ url ('teacher/attendance/report') }}" class="nav-link @if(Request::segment(3) == 'report') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Attendance Report</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item  @if(Request::segment(2) == 'homework')  menu-is-opening menu-open  @endif">
            <a href="#" class="nav-link @if(Request::segment(2) == 'homework')  active  @endif">
              <i class="nav-icon fas fa-table"></i>
              <p>
               HomeWork
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url ('teacher/homework/homework') }}" class="nav-link @if(Request::segment(3) == 'homework') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>HomeWork</p>
                </a>
              </li>
              </ul>
          </li>

          <li class="nav-item">
            <a href="{{ url ('teacher/my_notice_board') }}" class="nav-link @if(Request::segment(2) == 'my_notice_board') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
              My Notice Board
              </p>
            </a>
            </li>
           
          <li class="nav-item">
            <a href="{{ url ('teacher/account') }}" class="nav-link @if(Request::segment(2) == 'account') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
                My Account
              </p>
            </a>
            </li>

          <li class="nav-item">
            <a href="{{ url ('teacher/change_password') }}" class="nav-link @if(Request::segment(2) == 'change_password') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
               Change Password
              </p>
            </a>
            </li>

          @elseif(Auth::user()->user_type == 3)
          <li class="nav-item">
            <a href="{{ url ('student/dashboard')}}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                dashboard
              </p>
            </a>
          </li>

       <li class="nav-item">
            <a href="{{ url ('student/fees_collection') }}" class="nav-link @if(Request::segment(2) == 'fees_collection') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
                Fees Collection
              </p>
            </a>
            </li>

          <li class="nav-item">
            <a href="{{ url ('student/my_calender') }}" class="nav-link @if(Request::segment(2) == 'my_calender') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
                My Calender
              </p>
            </a>
            </li>

            <li class="nav-item">
            <a href="{{ url ('student/my_subject') }}" class="nav-link @if(Request::segment(2) == 'my_subject') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
                My Subject
              </p>
            </a>
            </li>

            <li class="nav-item">
            <a href="{{ url ('student/my_timetable') }}" class="nav-link @if(Request::segment(2) == 'my_timetable') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
                My Timetable
              </p>
            </a>
            </li>

            <li class="nav-item">
            <a href="{{ url ('student/my_exam_timetable') }}" class="nav-link @if(Request::segment(2) == 'my_exam_timetable') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
                My Exam Timetable
              </p>
            </a>
            </li>

            <li class="nav-item">
            <a href="{{ url ('student/my_exam_result') }}" class="nav-link @if(Request::segment(2) == 'my_exam_result') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
              My Exam Result
              </p>
            </a>
            </li>

            <li class="nav-item">
            <a href="{{ url ('student/my_attendance') }}" class="nav-link @if(Request::segment(2) == 'my_attendance') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
              My Attendance
              </p>
            </a>
            </li>
            <li class="nav-item">
            <a href="{{ url ('student/my_notice_board') }}" class="nav-link @if(Request::segment(2) == 'my_notice_board') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
              My Notice Board
              </p>
            </a>
            </li>  
            <li class="nav-item">
    <li class="nav-item">
            <a href="{{ url ('student/my_homework') }}" class="nav-link @if(Request::segment(2) == 'my_homework') active @endif">
            <i class="nav-icon far fa-user"></i>
              <p>
              My Homework
              </p>
            </a>
            </li>  
        <a href="{{ url ('student/my_submitted_homework') }}" class="nav-link @if(Request::segment(2) == 'my_submited_homework') active @endif">
            <i class="nav-icon far fa-user"></i>
              <p>
              My Submitted Homework
              </p>
            </a>
            </li>  


          <li class="nav-item">
            <a href="{{ url ('student/account') }}" class="nav-link @if(Request::segment(2) == 'account') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
                My Account
              </p>
            </a>
            </li>

          <li class="nav-item">
            <a href="{{ url ('student/change_password') }}" class="nav-link @if(Request::segment(2) == 'change_password') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
               Change Password
              </p>
            </a>
            </li>

          @elseif(Auth::user()->user_type == 4)
          <li class="nav-item">
            <a href="{{ url ('parent/dashboard')}}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                dashboard
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url ('parent/my_student') }}" class="nav-link @if(Request::segment(2) == 'account') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
                My Student
              </p>
            </a>
            </li>

            <li class="nav-item">
            <a href="{{ url ('parent/my_student_notice_board') }}" class="nav-link @if(Request::segment(2) == 'parent/my_student_notice_board') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
              My Student Notice Board
              </p>
            </a>
            </li>  

            <li class="nav-item">
            <a href="{{ url ('parent/my_notice_board') }}" class="nav-link @if(Request::segment(2) == 'my_notice_board') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
              My Notice Board
              </p>
            </a>
            </li>
            <li class="nav-item">
            <a href="{{ url ('parent/account') }}" class="nav-link @if(Request::segment(2) == 'account') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
                My Account
              </p>
            </a>
            </li>

          <li class="nav-item">
            <a href="{{ url ('parent/change_password') }}" class="nav-link @if(Request::segment(2) == 'change_password') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
               Change Password
              </p>
            </a>
            </li>

          @endif
          </li>  <a href="{{ url ('logout') }}" class="nav-link">
              <i class="nav-icon far fa-user"></i>
              <p>
                Logout
              </p>
            </a>
          </li>


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
   
    <!-- /.sidebar -->
  </aside>
   </div>