
const Router = require('express').Router(),
      Usuario = require('../server/modelo/usuario')

  Router.get('/buscar_y_verificar_usuarios', function(req, response) {
    Usuario.find({}, (err, usuarios) => {
      if (err) {
        return response.status(500).send({message: 'Error al intentar obtener los usuarios. (status:500)'})
      }else{if (usuarios.length <= 0) {
			let newUser1 = new Usuario()
      newUser1.nombre = 'Luis Vera'
      newUser1.email = 'lvera1992@gmail.com'
      newUser1.clave = 'lu1992'
			newUser1.save((err, usuario1) => {if (err) return response.status(500).send({message: 'Error al intentar insertar el usuario1. (status:500)'})
			})		
      let newUser2 = new Usuario()
      newUser2.nombre = 'Pedro Salazar'
      newUser2.email = 'psalazar@gamil.com'
      newUser2.clave = 'pedros'
      newUser2.save((err, usuario2) => {if (err) return response.status(500).send({message: 'Error al intentar insertar el usuario2. (status:500)'})
      })	
        }else{
          return res.json(usuarios)
        } 
      } 
    })
  })

module.exports = Router

