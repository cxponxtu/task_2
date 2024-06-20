#!/bin/bash

if [ "`groups | grep "mentee"`" ]
then
    echo "Select domain to submit task"
    domain=()
    i=0
    files=()
    tmp="`ls ~ -p | grep -v -e / -e task_submitted.txt -e task_completed.txt -e domain_pref.txt`"
    while read name
    do
        files[$i]=$name
        i=$((i+1))
    done <<< $tmp

    i=0
    while IFS=" " read -ra inp
    do
        domain[$i]="${inp[0]}"
        i=$((i+1))
    done < ~/domain_pref.txt

    select option in ${domain[@]}
    do
        read -p "Enter Task no. : " no
        if [[ $no -lt 4 ]] && [[ $no -gt 0 ]]
        then
            mkdir -p ~/$option/Task$no/
            case $option in 
                WebDev) 
                    python3 ~/.source/task_submit.py ${USER:1} web$no ;;
                AppDev)
                    python3 ~/.source/task_submit.py ${USER:1} app$no ;;
                SysAd)
                    python3 ~/.source/task_submit.py ${USER:1} sys$no ;;
            esac
            if [ "${files[@]}" ]
            then
                echo "Select file to submit : "
                select file in ${files[@]}
                do
                    cp ~/$file ~/$option/Task$no/
                    break
                done
                break
            fi
            break
        else
            echo "Enter valid no. "
            break
        fi
    done


elif [ "`groups | grep "mentor"`" ]
then 
    if [ "`groups | grep web`" ]
    then mentordom="WebDev"     
    elif [ "`groups | grep app`" ]
    then mentordom="AppDev"
    elif [ "`groups | grep sys`" ]
    then mentordom="SysAd"
    fi

    while IFS=" " read -ra mente
    do
        status=()
        if [ -d /home/core/Mentees/r${mente[1]}/$mentordom ]
        then
            alldir=(`dir /home/core/Mentees/r${mente[1]}/$mentordom`)
            for folders in ${alldir[@]}
            do  
                tasknum="`echo $folders | grep -o '[[:digit:]]*'`"

                if ! [[ -d ~/submittedTasks/$folders/${mente[1]} ]]
                then 
                    ln -s /home/core/Mentees/r${mente[1]}/$mentordom/$folders ~/submittedTasks/$folders/${mente[1]}
                fi 

                if [ "`dir ~/submittedTasks/$folders/${mente[1]}`" ]
                then status[$tasknum]="1"
                fi                  
            done

            for j in {1..3}
            do
                if [ -z ${status[$j]} ]
                then status[$j]="0"
                fi
            done
        
        case $mentordom in 
            WebDev) 
                python3 ~/.source/task_complete.py ${mente[1]} web1 ${status[1]}
                python3 ~/.source/task_complete.py ${mente[1]} web2 ${status[2]}
                python3 ~/.source/task_complete.py ${mente[1]} web3 ${status[3]} ;;
            AppDev)
                python3 ~/.source/task_complete.py ${mente[1]} app1 ${status[1]}
                python3 ~/.source/task_complete.py ${mente[1]} app2 ${status[2]}
                python3 ~/.source/task_complete.py ${mente[1]} app3 ${status[3]} ;;
            SysAd)
                python3 ~/.source/task_complete.py ${mente[1]} sys1 ${status[1]}
                python3 ~/.source/task_complete.py ${mente[1]} sys2 ${status[2]}
                python3 ~/.source/task_complete.py ${mente[1]} sys3 ${status[3]} ;;
        esac
        fi      
    done < ~/allocatedMentees.txt
fi
