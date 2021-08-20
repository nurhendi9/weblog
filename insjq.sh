mq="xx"
 i=0
 cnt=`redis-cli llen inssql`

 while [[ -n $mq ]] 
 do
    echo $i   


 data=`redis-cli rpop inssql`
 ip_address=`echo $data | jq -r '.ip_address'`
 date=`echo $data | jq -r '.date'`
 method=`echo $data | jq -r '.method'`
 status=`echo $data | jq -r '.status'`
 # ms=`echo $data | jq -r '.ms'`
 ms=`echo $data | jq -r '.ms'`
 site_request=`echo $data | jq -r '.site_request'`
 rt=`echo $data | jq -r '.rt'`
 uct=`echo $data | jq -r '.uct'`
 uht=`echo $data | jq -r '.uht'`
 urt=`echo $data | jq -r '.urt'`
 gz=`echo $data | jq -r '.gz'`
 mysql -u admin -padmin123 file -s -N -e "insert into data (ip_address, date, method, status, ms, site_request, rt, uct, uht, urt, gz) values ('$ip_address','$date','$method','$status','$ms','$site_request','$rt','$uct','$uht','$urt','$gz')"
 
 if [[ $i == $cnt ]]; then
     break;
 fi

  i=`expr $i + 1`
 done