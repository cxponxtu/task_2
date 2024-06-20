#!/bin/bash

i=0
domain=()
echo "Select the domain to deregister : "
while IFS=" " read -ra dom
do  
    i=$((i+1))
    domain[$i]="${dom[0]}"
done < ~/domain_pref.txt
select option in ${domain[@]}
do
    case $option in 
    WebDev)
        rm -rf ~/WebDev ~/.mentorWebDev 
        python3 ~/.source/de_regis.py ${USER:1} web ;;
    AppDev)
        rm -rf ~/AppDev ~/.mentorAppDev 
        python3 ~/.source/de_regis.py ${USER:1} app ;;
    SysAd)
        rm -rf ~/SysAd ~/.mentorSysAd 
        python3 ~/.source/de_regis.py ${USER:1} sys ;;
    esac
    l=0
    for (( j = 1; j <= ${#domain[@]}; j++ ))
    do 
        if [ "${domain[$j]}" != "$option" ]
        then
            domfin="$domfin${domain[$j]} $((j-l))\n"
        else
            l=$((l+1))
        fi
    done
    domfin=${domfin::-2}
    echo -e "$domfin" > ~/domain_pref.txt
    break
done
