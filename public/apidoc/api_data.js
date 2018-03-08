define({ "api": [
  {
    "type": "get",
    "url": "/v2/decode/result?token=:token",
    "title": "获取识别结果",
    "description": "<p>根据图片ID获取图片的识别结果</p>",
    "group": "Decode_Interface",
    "permission": [
      {
        "name": "JWT TOKEN"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>图片ID</p>"
          }
        ]
      }
    },
    "version": "0.2.0",
    "examples": [
      {
        "title": "curl示例:",
        "content": "curl -d \"id=15097995384666600001356001\" http://api.jiqishibie.com/v2/decode/result?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9",
        "type": "curl"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "Success-Response(成功响应 http状态码：200):",
          "content": "{\n  \"message\": \"success\",\n  \"status_code\": 200,\n  \"data\": {\n     \"id\": \"15097995384666600001356001\",\n     \"result\": \"good\"    #若为空表示识别中或ID不存在\n  }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/V2/ResultController.php",
    "groupTitle": "Decode_Interface",
    "name": "GetV2DecodeResultTokenToken",
    "sampleRequest": [
      {
        "url": "http://api.jiqishibie.com/v2/decode/result?token=:token"
      }
    ]
  },
  {
    "type": "get",
    "url": "/v2/report?token=:token",
    "title": "报错",
    "description": "<p>根据上传文件ID报错，报错后返还积分，15分钟内可报错</p>",
    "group": "Decode_Interface",
    "permission": [
      {
        "name": "JWT TOKEN"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>图片ID</p>"
          }
        ]
      }
    },
    "version": "0.2.0",
    "examples": [
      {
        "title": "curl示例:",
        "content": "curl -d \"id=15097995384666600001356001\" http://api.jiqishibie.com/v2/decode/result?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9",
        "type": "curl"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "Success-Response(成功响应 http状态码：200):",
          "content": "{\n  \"message\": \"success\",\n  \"status_code\": 200,    #报错成功\n  \"data\": null\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/V2/ReportController.php",
    "groupTitle": "Decode_Interface",
    "name": "GetV2ReportTokenToken",
    "sampleRequest": [
      {
        "url": "http://api.jiqishibie.com/v2/report?token=:token"
      }
    ]
  },
  {
    "type": "get",
    "url": "/v2/servers",
    "title": "可用服务器列表",
    "description": "<p>获取全部服务器列表地址</p>",
    "group": "Decode_Interface",
    "permission": [
      {
        "name": "None"
      }
    ],
    "version": "0.2.0",
    "examples": [
      {
        "title": "curl示例:",
        "content": "curl http://api.jiqishibie.com/v2/servers",
        "type": "curl"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "Success-Response(成功响应 http状态码：200):",
          "content": "{\n  \"message\": \"success\",\n  \"status_code\": 200,    #状态码200即为正确\n  \"data\": [\n      {\n          type: 1,       #1通用型，2登录服务器，3上传服务器，4获取结果服务器，5报错服务器\n          url: \"http//api.captcha.com\",\n          weight: 100\n      },\n      {\n          type: 2,\n          url: \"http//api.captcha.com\",\n          weight: 100\n      }\n   ]\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/V2/ServerController.php",
    "groupTitle": "Decode_Interface",
    "name": "GetV2Servers",
    "sampleRequest": [
      {
        "url": "http://api.jiqishibie.com/v2/servers"
      }
    ]
  },
  {
    "type": "post",
    "url": "/v2/decode/upload-base64?token=:token",
    "title": "上传图片base64编码",
    "description": "<p>将图片转换为base64编码后通过此接口上传到服务器</p>",
    "group": "Decode_Interface",
    "permission": [
      {
        "name": "JWT TOKEN"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "app_key",
            "description": "<p>软件KEY（默认系统key）</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "type_id",
            "description": "<p>图片类型ID</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "file",
            "description": "<p>图片的base64编码(必须包含类似data:image/png;base64的文件数据头)</p>"
          }
        ]
      }
    },
    "version": "0.2.0",
    "examples": [
      {
        "title": "curl示例:",
        "content": "curl \"type_id=100001&file=data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAMAAAARCA0dGVyY4LQCQAAABFXKwAAAABJRU5ErkJggg==\"\nhttp://api.jiqishibie.com/v2/decode/upload-base64?token=eyJ0eXAiOiJKV1QizI1NiJ9.eyJpc3MiOiJodHRwOi8NhcH4NzJkzAifQ.vwdP3rEVSnmbEoKTwAegcg0BaZ0sIQ",
        "type": "curl"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "Success-Response(成功响应 http状态码：200):",
          "content": "{\n     \"message\": \"success\",\n     \"status_code\": 200,\n     \"data\": {\n         \"id\": \"15097995384666600001356001\"    #id长26位\n     }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/V2/UploadController.php",
    "groupTitle": "Decode_Interface",
    "name": "PostV2DecodeUploadBase64TokenToken",
    "sampleRequest": [
      {
        "url": "http://api.jiqishibie.com/v2/decode/upload-base64?token=:token"
      }
    ]
  },
  {
    "type": "post",
    "url": "/v2/decode/upload?token=:token",
    "title": "上传图片数据流",
    "description": "<p>使用图片文件流的方式上传到服务器</p> <p>参数编码：Content-Type: multipart/form-data</p>",
    "group": "Decode_Interface",
    "permission": [
      {
        "name": "JWT TOKEN"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "app_key",
            "description": "<p>软件KEY（默认系统key）</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "type_id",
            "description": "<p>图片类型ID</p>"
          },
          {
            "group": "Parameter",
            "type": "FILE",
            "optional": false,
            "field": "file",
            "description": "<p>二进制文件流</p>"
          }
        ]
      }
    },
    "version": "0.2.0",
    "examples": [
      {
        "title": "curl示例:",
        "content": "curl -F \"file=@captcha.jpg\" -F \"type_id=10001\" http://api.jiqishibie.com/v2/decode/upload?api_token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9",
        "type": "curl"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "Success-Response(成功响应 http状态码：200):",
          "content": "{\n     \"message\": \"ok\",\n     \"status_code\": 200,\n     \"data\": {\n         \"id\": \"15097995384666600001356001\"    #id长26位\n     }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/V2/UploadController.php",
    "groupTitle": "Decode_Interface",
    "name": "PostV2DecodeUploadTokenToken",
    "sampleRequest": [
      {
        "url": "http://api.jiqishibie.com/v2/decode/upload?token=:token"
      }
    ]
  },
  {
    "type": "get",
    "url": "/v2/user/point?token=:token",
    "title": "获取用戶积分",
    "description": "<p>获取用戶积分（2~5分钟缓存）</p>",
    "group": "User_Interface",
    "permission": [
      {
        "name": "JWT TOKEN"
      }
    ],
    "version": "0.2.0",
    "examples": [
      {
        "title": "curl示例:",
        "content": "curl -i http://api.jiqishibie.com/v2/user/point?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MTk4NjkxOCwiZXhwIjoxNTEwNzYxNzE0fQ.v79tOJ5Ji_O4pqB03JBzFs-J2W3LLABYEw0MpCY1LCk",
        "type": "curl"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "Success-Response(成功响应 http状态码：200):",
          "content": "{\n   \"data\": {\n       \"point\": 10000,\n   }\n   \"status_code\": 200,\n   \"message\": \"success\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/V2/UserController.php",
    "groupTitle": "User_Interface",
    "name": "GetV2UserPointTokenToken",
    "sampleRequest": [
      {
        "url": "http://api.jiqishibie.com/v2/user/point?token=:token"
      }
    ]
  },
  {
    "type": "post",
    "url": "/v2/user/login",
    "title": "登录",
    "description": "<p>登录系统获取与服务器通信的token</p> <p>每次登录都将获取一个新的token，并且之前获取的token在其过期之前都可以使用</p> <p>若想紧急停止当前账户所有已生成的token，请到后台修改密码或更新个人安全密钥</p>",
    "group": "User_Interface",
    "permission": [
      {
        "name": "None(无)"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>邮箱地址（必填）</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>密码（必填）</p>"
          },
          {
            "group": "Parameter",
            "type": "Datetime",
            "optional": false,
            "field": "expired_at",
            "description": "<p>过期时间（最小24小时,最多30天后，如：2015-11-11 12:00:00）</p>"
          }
        ]
      }
    },
    "version": "0.2.0",
    "examples": [
      {
        "title": "curl示例",
        "content": "curl -d \"email=admin@example.com&password=123456\" http://api.jiqishibie.com/v2/user/login",
        "type": "curl"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "Success-Response(成功响应 http状态码：200):",
          "content": "{\n     \"data\": {\n         \"token\": \"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodCJwcnYiOiIyMhMjI0ZmU4ZjcwZTVjMzAifQ.vwdPRYi06EPxDF2sT3rEVSnmbEoKTwAegcg0BaZ0sIQ\",\n         \"token_expired_at\": \"2015-11-02 17:08:47\",            #token过期时间，默认过期时间为15天\n     }\n     \"status_code\": 200,\n     \"message\": \"\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response(错误响应 http状态码非200):",
          "content": "{\n     \"message\": \"邮箱或密码错误。\",\n     \"status_code\": 401,\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/V2/UserController.php",
    "groupTitle": "User_Interface",
    "name": "PostV2UserLogin",
    "sampleRequest": [
      {
        "url": "http://api.jiqishibie.com/v2/user/login"
      }
    ]
  }
] });
