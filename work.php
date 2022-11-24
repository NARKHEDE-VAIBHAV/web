<?php
include_once('test.php');

     foreach($tbl_blog_posts as $post){
      ?>
				





						<h2 class="entry-title">
							<h2><a href='index.php?id=<?php echo $post['post_id']; ?>' ><?php echo $post['title']; ?></a></h2>
						</h2> 				 
					
					
								<li> <?php echo date('d-m-y',strtotime($post['pub_date'])); ?></li>
															
							
					 
	
					
			
						<p><?php echo nl2br($post['content']); ?></p>
				
									 <?php   
     }
     ?>
