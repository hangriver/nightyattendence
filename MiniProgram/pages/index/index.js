// pages/index/index.js
Page({

  /**
   * 页面的初始数据
   */
  data: {

  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    wx.getStorage({
      key: 'uid',
      fail: function() {
        wx.navigateTo({
          url: '/pages/register/register',
        });
      },
    });
  },

  /**
   * 生命周期函数--监听页面初次渲染完成
   */
  onReady: function () {

  },

  /**
   * 生命周期函数--监听页面显示
   */
  onShow: function () {

  },

  /**
   * 生命周期函数--监听页面隐藏
   */
  onHide: function () {

  },

  /**
   * 生命周期函数--监听页面卸载
   */
  onUnload: function () {

  },

  /**
   * 页面相关事件处理函数--监听用户下拉动作
   */
  onPullDownRefresh: function () {

  },

  /**
   * 页面上拉触底事件的处理函数
   */
  onReachBottom: function () {

  },

  /**
   * 用户点击右上角分享
   */
  onShareAppMessage: function () {

  },

  tapScan: function () {
    wx.showLoading({
      title: '等待扫描',
      mask: true
    })
    var mydate = new Date();
    var lastdate;
    wx.getStorage({
      key: 'lastsign',
      success: function(res) {
        lastdate = res;
      },
    });
    /**var timeperiod = mydate - lastdate;
    if (timeperiod < 5400000) {
      wx.showModal({
        title: '无法签退',
        content: '距离签到时间过短，无法进行签退',
      });
    }*/
    var that = this;
    var key;
    var uid;
    //get uid from storage
    wx.getStorage({
      key: 'uid',
      success: function (res) {
        uid = res.data;
        console.log(uid);
      },
      fail: function () {
        console.log('failed to get uid');
      }
    });
    wx.scanCode({
      //Can only scan from camera
      onlyFromCamera: true,
      success: (res) => {
        console.log(res);
        //Put result into 'key'
        key = res.result;
        console.log(key);
        //request server for increase credit
        wx.showToast({
          title: '正在连接服务器',
          mask: true,
          icon: 'loading',
          duration: 11000
        })
        wx.request({
          url: 'https://sign.student.ac.cn/check.php',
          data: {
            uid: uid,
            timekey: key
          },
          success: function (res) {
            console.log(res.data);
            //get right status code

            if (res.data['status'] == 666) {
              wx.showModal({
                title: '签到成功',
                content: '积分已经增加，短时间内重复扫描将受到惩罚',
              });
              wx.showToast({
                title: '请退出小程序',
                icon: 'success',
                mask: true,
                duration: 300000
              })
              var datenow = new Date();
              wx.setStorage({
                key: 'lastsign',
                data: datenow,
                success: function(){
                  console.log('setted');
                  }
              });
            } else {
              //wrong status code
              wx.showToast({
                title: '错误，代码：' + res.data['status'],
                icon: 'none'
              })
            }
          },
          fail: function() {
            wx.showModal({
              title: '连接错误',
              content: '扫码失败，请重新尝试',
            })
          }
        })
      },
      fail: (res) => {
        //Notice if failed
        wx.showToast({
          title: '扫码失败',
          icon: 'none',
          image: '',
          duration: 3000,
          mask: true,
          success: function (res) { },
          fail: function (res) { },
          complete: function (res) { },
        })
      }
    });
  },

  tapGroup: function(){
    wx.navigateTo({
      url: '../group/group',
    })
  },

  LBSSign: function() {
    wx.showLoading({
      title: '等待定位',
    })
    wx.getLocation({
      success: function(res) {
        wx.hideLoading();
        console.log(res);
        console.log(res.latitude);
        console.log(res.longitude);
        var lat = res.latitude;
        var lon = res.longitude;
        var uid;
        wx.getStorage({
          key: 'uid',
          success: function(res) {
            uid = res.data;
            console.log(uid);
            if (32.134 <= lat && 32.135 >= lat && 118.695 <= lon && 118.696 >= lon) {
              console.log("location match");
              wx.showLoading({
                title: '连接服务器....',
              })
              console.log(uid);
              wx.request({
                url: 'https://sign.student.ac.cn/plus.php',
                data: {
                  uid: uid,
                  status: 666
                },
                success: function (res) {
                  wx.hideLoading();
                  console.log('返回：' + res.data);
                  //get right status code

                  if (res.data['status'] == 666) {
                    wx.showModal({
                      title: '签到成功',
                      content: '请自觉在足额学习后再次签到',
                    });
                    wx.showToast({
                      title: '请务必学习足够时间',
                      icon: 'fail',
                      mask: true,
                      duration: 300000
                    })
                    var datenow = new Date();
                    wx.setStorage({
                      key: 'lastsign',
                      data: datenow,
                      success: function () {
                        console.log('setted');
                      }
                    });
                  } else {
                    //wrong status code
                    wx.showToast({
                      title: '错误，代码：' + res.data['status'],
                      icon: 'none'
                    })
                  }
                },
                fail: function () {
                  wx.showModal({
                    title: '连接错误',
                    content: '签到失败，请重新尝试',
                  })
                }
              })
            } else {
              wx.showModal({
                title: '您不在正确的签到区域',
                content: '请前往图书馆签到',
              })
            }
          },
          fail: function(res) {
            console.log("failed to get uid");
          }
        })
      },
    })
  },

  LBSinfo: function(){
    wx.showLoading({
      title: '等待定位',
    })
    wx.getLocation({
      success: function(res) {
        wx.showModal({
          title: '地理位置信息如下',
          content: '经度：'+res.longitude+'；纬度：'+res.latitude+'；精度：'+res.accuracy+'；高度：'+res.altitude+'；速度：'+res.speed+'。',
        })
      },
      fail: function(){
        wx.showModal({
          title: '采集出错',
          content: '检查权限授予情况：1.微信内部是否对小程序授权 2.iOS或Android是否对微信授权',
        })
      }
    })
  },

  startRUN: function(){
    console.log('start')
    wx.login({
      success(res) {
        if (res.code) {
          // 发起网络请求
          wx.request({
            url: 'https://sign.student.ac.cn/login.php',
            data: {
              code: res.code
            },
            success: function (res) {
              if (res.status == 666) {
                console.log('ok');
              } else {
                console.log('failed');
              }
            }
          })
        } else {
          console.log('登录失败！' + res.errMsg)
        }
      }

    })
    wx.getWeRunData({
      success:function(res) {
        wx.request({
          url: 'http://sign.student.ac.cn/login.php',
          data:{
            iv: res.iv,
            encrypteddata: res.encryptedData
          },
          success: function(res){
           wx.setStorage({
             key: 'step',
             data: res.step,
           })
          }
        })
      }
    })
  },


  endRUN: function(){
    wx.login({
      success(res) {
        if (res.code) {
          // 发起网络请求
          wx.request({
            url: 'https://sign.student.ac.cn/login.php',
            data: {
              code: res.code
            },
            success: function (res) {
              if (res.status == 666) {
                console.log('ok');
              } else {
                console.log('failed');
              }
            }
          })
        } else {
          console.log('登录失败！' + res.errMsg)
        }
      }

    })
    wx.getWeRunData({
      success(res) {
        wx.request({
          url: 'http://sign.student.ac.cn/login.php',
          data: {
            iv: res.iv,
            encrypteddata: res.encryptedData
          },
          success(res) {
            step = res.step
            wx.getStorage({
              key: 'step',
              success: function (res) {
                if (step - res.step >= 400) {
                  wx.showModal({
                    title: '成功',
                    content: '您已完成跑操',
                  })
                }
              }
            })
          }
        })
      }
    })
  }

})