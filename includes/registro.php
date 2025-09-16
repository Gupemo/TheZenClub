                <form action="../MVC/core/router.php" class="form" method="POST" enctype="multipart/form-data">
                    <div class="camp">
                        <label for="userName">Nombre:</label>
                        <input type="text" name="userName" id="userName" placeholder="Indica tu nombre">
                        <small></small>
                    </div>
                    <div class="camp">
                        <label for="userSubname">Apellidos:</label>
                        <input type="text" name="userSubname" id="userSubname" placeholder="Indica tus apellidos">
                        <small></small>
                    </div>
                    <div class="camp">
                        <label for="userEmail">Correo Electrónico:</label>
                        <input type="email" value="<?= $invitacion['email'] ?>" disabled>
                        <input type="hidden" name="userEmail" value="<?= $invitacion['email'] ?>">
                        <small></small>
                    </div>
                    <div class="camp">
                        <label for="userPassword">Contraseña:</label>
                        <input type="password" name="userPassword" id="userPassword" placeholder="indica tu contraseña">
                        <small></small>
                    </div>
                    <div class="camp">
                        <label for="userPhone">Teléfono:</label>
                        <input type="tel" name="userPhone" id="userPhone" placeholder="indica tu número de teléfono">
                        <small></small>
                    </div>
                    <div class="camp">
                        <label for="userBirthDate">Fecha de nacimiento:</label>
                        <input type="date" name="userBirthDate" id="userBirthDate">
                        <small></small>
                    </div>
                    <div class="camp">
                        <label for="userSex">Indica tu sexo</label>
                        <select name="userSex" id="userSex">
                            <option value="none"></option>
                            <option value="Hombre">Hombre</option>
                            <option value="Mujer">Mujer</option>
                            <small></small>
                        </select>
                    </div>
                    <div class="camp">
                        <label for="profilePicture">Imagen de perfil</label>
                        <input type="file" name="profilePicture" id="profilePicture">

                    </div>
                    <div class="camp">
                        <label for="check1">¿Padeces algun tipo de patología relevante? (asma, epilepsia...)</label>
                        <input type="checkbox" name="deseases" id="check1">
                    </div>
                    <div class="camp hidden" id="patologies">
                        <label for="deseasesTextarea">Patologías</label>
                        <textarea name="userDeseases" id="deseasesTextarea" placeholder="Indicanos que patologia padeces"></textarea>
                    </div>
                    <div class="camp">
                        <label for="check2">¿Quieres añadir una persona de contacto? (Podrás hacerlo más tarde)</label>
                        <input type="checkbox" id="check2" name="check2">
                    </div>
                    <hr class="hrform hidden" id="hrform">
                    <div class="hidden" id="group">

                        <h2>Persona de contacto</h2>
                        <div class="camp">
                            <label for="userContactName">Nombre</label>
                            <input type="text" name="userContactName" id="userContactName" placeholder="Nombre de la persona de contacto">
                        </div>
                        <div class="camp">
                            <label for="userContactSubname">Apellidos</label>
                            <input type="text" name="userContactSubname" id="userContactSubname" placeholder="Apellidos de la persona de contacto">
                        </div>
                        <div class="camp">
                            <label for="userKindShip">Parentesco</label>
                            <input type="text" name="kindship" id="kindship">
                        </div>
                        <div class="camp">
                            <label for="userContactPhone">Teléfono</label>
                            <input type="tel" name="userContactPhone" id="userContactPhone" placeholder="Teléfono de la persona de contacto">
                        </div>
                        
                    </div>
                    <div class="camp">
                        <label for="conditions">He leído y acepto los <a id="termsModal" class="termsModal">términos y condiciones</a></label>
                        <input type="checkbox" name="conditions" id="conditions">
                        <small></small>
                    </div>
                    <div class="modal" id="modal">
                        <div class="modal__content">
                            <span class="closeSpan" id="closeSpan">&times;</span>
                            <h2>Términos y condiciones</h2>
                            <div class="modal__text" id="modal__text">
                            </div>
                            
                        </div>
                    </div>
                    
                    <div class="camp">
                        <?php
                            $token = $_GET['token'];
                        ?>
                        <input type="hidden" name="token" value="<?=$token?>">
                        <input type="hidden" name="registro" value="registro">
                        <input type="submit" id="btnSubmit" class="boton" value="Enviar">
                    </div>
                </form>