


<?php


	
	function download($conn,$type,$id){
			$lob  = oci_new_descriptor($conn, OCI_D_LOB);
			if($type == 'image') {
				$sql = 'select * from images where image_id='.$id;
				$stid = oci_parse($conn,$sql);
				oci_execute($stid,OCI_DEFAULT);
				oci_fetch($stid);
				$photo = oci_result($stid, 'RECOREDED_DATA');
				return $photo->load();
			}
			if($type == 'audio') {
				$sql = 'select * from audio_recordings where recording_id='.$id;
				$stid = oci_parse($conn,$sql);
				oci_execute($stid,OCI_DEFAULT);
				oci_fetch($stid);
				$audiofile = oci_result($stid, 'RECORDED_DATA');
				return $audiofile->load();
			}
			if($type == 'scalar') {
				$sql = 'select * from scalar_data where id='.$id;
				$stid = oci_parse($conn,$sql);
				oci_execute($stid,OCI_DEFAULT);
				oci_fetch($stid);
				$file = oci_result($stid, 'VALUE');
				return $file->load();
			}
	}


?>


