<?php
	class User{	
		function chargementUser($login, $password, $pdo){
			$sql = "SELECT * FROM users LEFT JOIN users_groupes ON users.userId = users_groupes.userId  WHERE userLogin='".$login."' AND userPassword='".hash('sha256', $password)."' AND userActif = 1";
			$res = $pdo->prepare($sql);
			$res->execute();
			
			$count = $res->rowCount();
			if($count == 1){
				while($row = $res->fetch()) {
					$_SESSION['user']['userId'] 		= $row['userId'] ;
					$_SESSION['user']['userNom'] 		= $row['userNom'] ;
					$_SESSION['user']['userPrenom'] 	= $row['userPrenom'] ;
					$_SESSION['user']['userGrade'] 		= $row['userGrade'] ;
					$_SESSION['user']['userMail'] 		= $row['userMail'] ;
					$_SESSION['user']['userTelephone'] 	= $row['userTelephone'] ;
					$_SESSION['user']['userActif'] 		= $row['userActif'] ;
					$_SESSION['user']['userPassword'] 	= $row['userPassword'] ;
					$_SESSION['user']['userLogin'] 		= $row['userLogin'] ;
					$_SESSION['user']['userSexe'] 		= $row['userSexe'] ;
				}
			}
		}
		function chargementUserAD($domaine, $user, $password, $pdo){
			$adServer = $domaine;	
			$ldap = ldap_connect($adServer);
			$username = $user;
			$password = $password;
			$ldaprdn = 'cdaoa' . "\\" . $username;
			ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
			ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);
			$bind = @ldap_bind($ldap, $ldaprdn, $password);
			if ($bind) {
				$filter="(sAMAccountName=$username)";
				$result = ldap_search($ldap,"dc=cdaoa,dc=air",$filter);
				@ldap_sort($ldap,$result,"sn");
				$info = ldap_get_entries($ldap, $result);
				for ($i=0; $i<$info["count"]; $i++)
				{	
					/*
					echo "<p>You are accessing <strong> ". $info[$i]["cn"][0] .", " . $info[$i]["distinguishedname"][0] ."</strong><br /> (" . $info[$i]["samaccountname"][0] .")</p>\n";
					echo '<pre>';
					
					print_r($info[$i]);
					echo '</pre>';
					*/
					
					
					
					$sql = "SELECT * FROM users WHERE userLogin='".$user."'";
					
					$res = $pdo->prepare($sql);
					$res->execute();
					
					$count = $res->rowCount();
					//echo $count;
					if($count == 1){
						while($row = $res->fetch()) {
							$_SESSION['user']['userId'] 		= $row['userId'] ;
						}
						$_SESSION['user']['userLogin'] 		= $info[$i]["samaccountname"][0] ;
						if(isset($info[$i]["sn"][0])) $_SESSION['user']['userNom'] 		= $info[$i]["sn"][0] ;
						else $_SESSION['user']['userNom'] = '';
						if(isset($info[$i]["givenname"][0])) $_SESSION['user']['userPrenom'] 	= $info[$i]["givenname"][0] ;
						else $_SESSION['user']['userPrenom'] = '';
						if(isset($info[$i]["mail"][0])) $_SESSION['user']['userMail'] 		= $info[$i]["mail"][0] ;
						else $_SESSION['user']['userMail'] = '';
						if(isset($info[$i]["telephonenumber"][0])) $_SESSION['user']['userTelephone'] 	= $info[$i]["telephonenumber"][0] ;
						else $_SESSION['user']['userTelephone'] = '';
						
						$_SESSION['user']['userActif'] 		= 1 ;					
						$_SESSION['user']['userPassword'] 	= hash('sha256', $password) ;
						return 'ok';
					}
					return 'vous n\'avez pas accès à ce portail';
				}
				@ldap_close($ldap);
			}
			return 'Le couple login et mot de passe ne fonctionne pas';
		}
		function verifAccesAdmin($pdo){
			$sql = "select COUNT(*) AS nb_messages from groupes LEFT JOIN users_groupes on groupes.groupeId = users_groupes.groupeId where groupeSystem = 1 and userID = ".$_SESSION['user']['userId'];
			$res = $pdo->prepare($sql);
			$res->execute();			
			return $res->fetchColumn();
		}
	}
?>