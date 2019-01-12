// pages/register/register.js
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

  sendID: function (event) {
    console.log(event.detail);
    wx.request({
      url: 'https://sign.student.ac.cn/register.php',
      data: event.detail.value,
      success: function (res) {
        console.log(res.data);
        wx.setStorage({
          key: 'uid',
          data: res.data.uid,
          success: function() {
            console.log('success')
          }
        });
        wx.navigateBack({})
      },
      fail: function() {
        console.log('connection failed');
        wx.showToast({
          title: '网络错误',
          icon: 'none'
        })
      }
    })
  },

  formReset: function() {
    
  }
})