#!/bin/bash

for grp in mentor webmentor appmentor sysmentor mentee
do 
	sudo groupadd $grp
done 
mkdir -p /home/core/Mentors/WebDev /home/core/Mentors/AppDev /home/core/Mentors/SysAd /home/core/Mentees
dir=()
i=0
files="`ls -A /home/core/ | grep -v -e Mentors -e Mentees`"
while read tmp
do
	dir[$i]=$tmp
	i=$((i+1))
done <<< $files

for (( i = 0; i < ${#dir[@]}; i++ ))
do
	sudo setfacl -m u:core:rwx,g::---,o::--- ~/${dir[$i]}	
done
 
cp /home/core/.source/mentees_domain.txt /home/core/ 
sudo setfacl -m u:core:rwx,g:mentee:-w-,g::---,o::r-- /home/core/mentees_domain.txt
sudo ln -s /home/core/mentees_domain.txt /var/www/gemini.club/

i=0
while IFS=" " read -ra name 
do 
	if [ $i -eq 1 ]
	then
		case ${name[1]} in
			web) sudo useradd -md /home/core/Mentors/WebDev/${name[0]} ${name[0]} -G mentor,webmentor -s /bin/bash
				sudo touch /home/core/Mentors/WebDev/${name[0]}/allocatedMentees.txt 
				sudo mkdir -p /home/core/Mentors/WebDev/${name[0]}/submittedTasks/Task1 /home/core/Mentors/WebDev/${name[0]}/submittedTasks/Task2 /home/core/Mentors/WebDev/${name[0]}/submittedTasks/Task3 /home/core/Mentors/WebDev/${name[0]}/.source
				sudo cp /home/core/.source/task_complete.py /home/core/.source/4alias.sh /home/core/.source/8alias.sh /home/core/Mentors/WebDev/${name[0]}/.source
				sudo setfacl -Rm u:core:rwx,u:${name[0]}:rwx,g::---,o::--- /home/core/Mentors/WebDev/${name[0]}/ 
				sudo echo -e "alias submitTask='bash /home/core/Mentors/WebDev/${name[0]}/.source/4alias.sh'; alias setQuiz='bash /home/core/Mentors/WebDev/${name[0]}/.source/8alias.sh'\nsource ~/.source/env.sh" >> /home/core/Mentors/WebDev/${name[0]}/.bashrc
				sudo echo -e "export MYSQL_HOST='$MYSQL_HOST'\nexport MYSQL_USER='$MYSQL_USER'\nexport MYSQL_PASSWORD='$MYSQL_PASSWORD'" > /home/core/Mentors/WebDev/${name[0]}/.source/env.sh	
				sudo chmod 777 /home/core/Mentors/WebDev/${name[0]}/.source/env.sh 
				python3 /home/core/.source/user_gen_mentor.py ${name[0]} web ${name[2]};;
			app) sudo useradd  -md /home/core/Mentors/AppDev/${name[0]} ${name[0]} -G mentor,appmentor -s /bin/bash
				sudo touch /home/core/Mentors/AppDev/${name[0]}/allocatedMentees.txt
				sudo mkdir -p /home/core/Mentors/AppDev/${name[0]}/submittedTasks/Task1 /home/core/Mentors/AppDev/${name[0]}/submittedTasks/Task2 /home/core/Mentors/AppDev/${name[0]}/submittedTasks/Task3 /home/core/Mentors/AppDev/${name[0]}/.source
				sudo cp /home/core/.source/task_complete.py /home/core/.source/4alias.sh /home/core/.source/8alias.sh /home/core/Mentors/AppDev/${name[0]}/.source
				sudo setfacl -Rm u:core:rwx,u:${name[0]}:rwx,g::---,o::--- /home/core/Mentors/AppDev/${name[0]}/
				sudo echo -e "alias submitTask='bash /home/core/Mentors/AppDev/${name[0]}/.source/4alias.sh'; alias setQuiz='bash /home/core/Mentors/AppDev/${name[0]}/.source/8alias.sh'\nsource ~/.source/env.sh" >> /home/core/Mentors/AppDev/${name[0]}/.bashrc
				sudo echo -e "export MYSQL_HOST='$MYSQL_HOST'\nexport MYSQL_USER='$MYSQL_USER'\nexport MYSQL_PASSWORD='$MYSQL_PASSWORD'" > /home/core/Mentors/AppDev/${name[0]}/.source/env.sh	
				sudo chmod 777 /home/core/Mentors/AppDev/${name[0]}/.source/env.sh 
				python3 /home/core/.source/user_gen_mentor.py ${name[0]} app ${name[2]};;
			sysad) sudo useradd  -md /home/core/Mentors/SysAd/${name[0]} ${name[0]} -G mentor,sysmentor -s /bin/bash
				sudo touch /home/core/Mentors/SysAd/${name[0]}/allocatedMentees.txt
				sudo mkdir -p /home/core/Mentors/SysAd/${name[0]}/submittedTasks/Task1 /home/core/Mentors/SysAd/${name[0]}/submittedTasks/Task2 /home/core/Mentors/SysAd/${name[0]}/submittedTasks/Task3 /home/core/Mentors/SysAd/${name[0]}/.source
				sudo cp /home/core/.source/task_complete.py /home/core/.source/4alias.sh /home/core/.source/8alias.sh /home/core/Mentors/SysAd/${name[0]}/.source
				sudo setfacl -Rm u:core:rwx,u:${name[0]}:rwx,g::---,o::--- /home/core/Mentors/SysAd/${name[0]}/
				sudo echo -e "alias submitTask='bash /home/core/Mentors/SysAd/${name[0]}/.source/4alias.sh'; alias setQuiz='bash /home/core/Mentors/SysAd/${name[0]}/.source/8alias.sh'\nsource ~/.source/env.sh" >> /home/core/Mentors/SysAd/${name[0]}/.bashrc
				sudo echo -e "export MYSQL_HOST='$MYSQL_HOST'\nexport MYSQL_USER='$MYSQL_USER'\nexport MYSQL_PASSWORD='$MYSQL_PASSWORD'" > /home/core/Mentors/SysAd/${name[0]}/.source/env.sh	
				sudo chmod 777 /home/core/Mentors/SysAd/${name[0]}/.source/env.sh 
				python3 /home/core/.source/user_gen_mentor.py ${name[0]} sys ${name[2]};;
		esac
		
	fi
	i=1
done < /home/core/mentorDetails.txt

i=0
while IFS=" " read -ra name 
do 
	if [ $i -eq 1 -a [$name[1]] ]
	then
		sudo useradd -md /home/core/Mentees/r${name[1]} r${name[1]} -G mentee -s /bin/bash
		sudo mkdir /home/core/Mentees/r${name[1]}/.source
		sudo cp /home/core/.source/de_regis.py /home/core/.source/task_submit.py /home/core/.source/domain_pref.py /home/core/.source/quiz.sh /home/core/.source/2alias.sh /home/core/.source/4alias.sh /home/core/.source/6alias.sh /home/core/Mentees/r${name[1]}/.source	
		sudo touch /home/core/Mentees/r${name[1]}/domain_pref.txt 
		sudo setfacl -Rm u:core:rwx,u:r${name[1]}:rwx,g:mentor:rwx,g::---,o::--- /home/core/Mentees/r${name[1]}/
		sudo echo "/home/core/Mentees/r${name[1]}/.source/quiz.sh" >> /home/core/Mentees/r${name[1]}/.profile
		echo -e "alias domainPref='bash /home/core/Mentees/r${name[1]}/.source/2alias.sh'; alias submitTask='bash /home/core/Mentees/r${name[1]}/.source/4alias.sh'; alias deRegister='bash /home/core/Mentees/r${name[1]}/.source/6alias.sh'\n source ~/.source/env.sh" >> /home/core/Mentees/r${name[1]}/.bashrc
		sudo echo ${name[0]} > /home/core/Mentees/r${name[1]}/.name
		python3 /home/core/.source/user_gen_mentee.py ${name[0]} ${name[1]}
		sudo echo -e "export MYSQL_HOST='$MYSQL_HOST'\nexport MYSQL_USER='$MYSQL_USER'\nexport MYSQL_PASSWORD='$MYSQL_PASSWORD'" > /home/core/Mentees/r${name[1]}/.source/env.sh
		sudo chmod 777 /home/core/Mentees/r${name[1]}/.source/env.sh

	fi
	i=1
done < /home/core/menteeDetails.txt

mkdir /home/core/.pers
sudo cp /etc/passwd /etc/group  /home/core/.pers
