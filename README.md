#Graduation Application
Final project for a Systems Anaylsis and Design class
-------------------------------------------------------

Built with Laravel and Bootstrap, Using a MySQL database. 

### This is a prototype demonstration for a final project at school. It's built under a few assumptions -

- One assumption being that the student is logged into the the schools student management system. 
- Two being that we have access to the proper databases.

Since we obviously can't access all of the students information we created a simulated database environment with existing students, courses, degress, etc. 

Two actors are involved with application - The student and the administrator. The student can submit and view their application. The admin can review (accept or reject) all of the students applications. 

If you would like to try it, I currently have it hosted here [Grad-App](http://m.patrickkremer.me "Patrick Kremer").

### A valid student number will be 900000001 to 900000006. 

Once a student applys an email is generated and sent to the student. Although, for testing purposes all emails will be directed to me. Individual student applications can be viewed using a URL pattern /report/900#

### Admins can then reject or accept the applicant. 

A list of students will first be displayed and the admin can choose a report to review. The admin can also leave any notes needed. Once the admin updates the graduation report, the system will generate another email to inform the student of whether they were accepted or rejected for graduation. Too access the admin panel simply change the URL to /admin.
