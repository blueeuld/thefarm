<?php
$return = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/services';
?>
<div class="panel-heading"><b><i class="glyphicon glyphicon-briefcase"></i> Package Types</b></div>


<div class="panel-body">
								
									<div class="pull-right">
										<a
												href="<?php echo site_url('backend/packagetype/edit?return=' . urlencode($return)); ?>"
												class="btn btn-primary" data-toggle="modal" data-target="#modal-popup">Add
												<i class="fa fa-plus"></i></a>
									</div>
									<div class="table-responsive">
										<table class="table table-striped table-hover dt-responsive no-footer dtr-inline">
											<tbody>
											<?php foreach ($packagetypes as $row) : ?>
												<tr>
													<td>
														<?php echo anchor('backend/packagetype/edit/' . $row['package_type_id'] . '?return=' . urlencode($return), $row['package_type_name'], 'class="text-regular" data-toggle="modal" data-target="#modal-popup"'); ?></td>
													<td class="text-center">
														<a href="<?php echo site_url('backend/packagetype/edit/' . $row['package_type_id'] . '?return=' . urlencode($return)); ?>"
														   class="btn btn-xs btn-icon btn-primary" data-toggle="modal"
														   data-target="#modal-popup"><i
																class="fa fa-pencil"></i></a>
														<a href="<?php echo site_url('backend/packagetype/delete/' . $row['package_type_id']); ?>"
														   class="btn btn-xs btn-icon btn-default btn-confirm"
														   title="Are you sure you want to delete this item?"><i
																class="fa fa-trash-o"></i></a>
													</td>
												</tr>
											<?php endforeach ?>
											</tbody>
										</table>
									</div>
								</div>
