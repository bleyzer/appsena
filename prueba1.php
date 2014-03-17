<?php
include 'libs/db_connect.php';
   $id = $_GET['tipo'];
   $query = "select * from recetas where id = ".$id;
            $stmt = $con->prepare( $query );
            
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
	        extract($row);
// echo "Tu id es: ".$id." Tu nombre es: ".$nombre;

	        echo '
                <div class="form-group text-center"> 

                    <div class="row">   
                      <form action="#" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="idReceta" value="'.$id.'">
                       
                        <div class="row">
                          <div class="col-md-3"></div>
                          <div class="col-md-2"><h4>Nombre: </h4></div>
                          <div class="col-md-1"><input type="hidden" name="valorNombre" value="'.$nombre.'"></div>
                          <div class="col-md-3"><input type="text" name="nombre" value="'.$nombre.'"></div>
                          <div class="col-md-3"></div>
                        </div>
                                <br>
                        <div class="row">
                          <div class="col-md-3"></div>
                          <div class="col-md-2"><h4>Ingredientes: </h4></div>
                          <div class="col-md-1"><input type="hidden" name="valorIngredientes" value="'.$ingredientes.'"></div>
                          <div class="col-md-4"><textarea class="form-control" name="ingredientes" rows="5">'.$ingredientes.'</textarea></div>
                          <div class="col-md-2"></div>
                        </div>
                                <br>
                        <div class="row">
                          <div class="col-md-3"></div>
                          <div class="col-md-2"><h4>Preparación: </h4></div>
                          <div class="col-md-1"><input type="hidden" name="valorPreparacion" value="'.$preparacion.'"></div>
                          <div class="col-md-4"><textarea class="form-control" name="preparacion" rows="5">'.$preparacion.'</textarea></div>
                          <div class="col-md-2"></div>

                        </div>
                        <br> 

                        <div class="row">
                          <div class="col-md-3"></div>
                          <div class="col-md-2"><h4>Categoria: </h4></div>
                          <div class="col-md-1"></div>
                            <div class="col-md-4">
                                                   
                          <select class="form-control" name="categoria">
                            <option>Comidas</option>
                            <option>Bebidas</option>
                            <option>Ensaladas</option>
                          </select> </div>

                          <div class="col-md-2"></div>

                        </div>
                         <br> 
                        <div class="row">
                          <div class="col-md-3"></div>
                          <div class="col-md-1"><h4>Imagen: </h4></div>
                          <div class="col-md-1"></div>
                          <div class="col-md-3"><p><input type="file" accept="image/jpg" name="imagen"/></p></div>
                          <div class="col-md-3"></div>

                        </div>

                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <input type="hidden" name="action" value="update" />
                          <input type="submit" class="btn btn-primary"  value="Guardar">
                        </div>

                      </form>
                    </div> 
                  </div>



              </div>




          ';
?>