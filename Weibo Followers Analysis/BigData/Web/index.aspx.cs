using System;
using System.Collections.Generic;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

namespace Maticsoft.Web
{
    public partial class index : System.Web.UI.Page
    {
        protected void Page_Load(object sender, EventArgs e)
        {
            /*
             * 暴力搜索互粉量超过5的人
            BLL.atbiao bll = new BLL.atbiao();
            List<string> Glist = new List<string>();
            List<string> Ilist = bll.GetIdList();
            for (int i = 0; i < Ilist.Count; i++)
            { 
                Glist = GetHuList(Ilist[i]);
                if (Glist == null)
                {
                    continue;
                }
                if (Glist.Count > 5) {
                    int j = 0;
                }
            }
            */

            /*
             * 寻找特殊人群
            if (IsPostBack) 
            {
                String id = Request.Form["inid"];
                BLL.atbiao bll = new BLL.atbiao();
                List<string> Glist = new List<string>();
                Glist = GetHuList(id);
                List<string> Flist = new List<string>();
                Flist = Seek(id);
                if (Flist == null) 
                {
                    String str = "404 not found";
                    Flist = new List<string>();
                    Flist.Add(str);
                }
                Repeater1.DataSource = Flist;
                Repeater1.DataBind();
            }
            */

            /*
             * 找关注某人的人
             * 巴松狼王
            
            String id = "1244589914";
            List<string> Wlist = WhoGuanHe(id);
            BLL.atbiao bll = new BLL.atbiao();
            List<string> Glist = new List<string>();
            for (int i = 0; i < Wlist.Count; i++)
            {
                Glist = bll.GetGuanList(Wlist[i]);
                if (Glist == null)
                {
                    continue;
                }
                for (int j = 0; j < Glist.Count; j++)
                {
                    int num = bll.BaNum(Glist[j]);
                    if (num == 0)
                    {
                        bll.BaRecord(Glist[j], 1);
                    }
                    else
                    {
                        bll.UDBaRecord(Glist[j], num + 1);
                    }
                }
            }
             */

            /*
             * 测试使用
            string id = "2";
            BLL.atbiao bll = new BLL.atbiao();
            int num = bll.BeiNum(id);
            Boolean ok = bll.BeiRecord("12",3);
             * */

            /*
             * 暴力寻大V
            BLL.atbiao bll = new BLL.atbiao();
            List<string> Glist = new List<string>();
            List<string> Ilist = bll.GetIdList();
            for (int i = 25808; i < Ilist.Count; i++)
            {
                //25808
                Glist = bll.GetGuanList(Ilist[i]);
                if (Glist == null)
                {
                    continue;
                }
                for (int j = 0; j < Glist.Count; j++)
                {
                    int num = bll.BeiNum(Glist[j]);
                    if (num == 0)
                    {
                        bll.BeiRecord(Glist[j], 1);
                    }
                    else 
                    {
                        bll.UDBeiRecord(Glist[j],num+1);
                    }
                }
            }
            */

        }
        //搜索特殊人群
        protected List<string> Seek(string id)
        {
            int MAX = 3;//阀值
            List<string> list = new List<string>();      
            //获取被关注人列表
            List<string> BeiGuanZhu = GetHuList(id);
            if (BeiGuanZhu == null) 
            {
                return null;
            }
            for (int i = 0, count = 0; i < BeiGuanZhu.Count; i++, count = 0)
            {
                string temp_id = BeiGuanZhu[i];
                for (int j = 0; j < BeiGuanZhu.Count; j++)
                {
                    List<string> TempBeiGuanZhu = GetHuList(BeiGuanZhu[j]);
                    for (int z = 0; z < TempBeiGuanZhu.Count; z++)
                    {
                        if (temp_id == TempBeiGuanZhu[z])
                        {
                            count++;
                        }
                    }
                }
                if (count * MAX < BeiGuanZhu.Count)
                {
                    list.Add(temp_id);
                }

            }
            return list;
        }
        //搜索互粉人
        protected List<string> GetHuList( string id) 
        {
            List<string> Hlist = new List<string>();
            BLL.atbiao bll = new BLL.atbiao();
            List<string> Glist = bll.GetGuanList(id);
            if (Glist == null)
            {
                return null;
            }
            for (int i = 0; i < Glist.Count; i++) 
            {
                int flag = 0;
                List<string> BeiList = bll.GetGuanList(Glist[i]);
                //此人不存在，查下一个
                if (BeiList == null)
                {
                    continue;
                }
                for (int j = 0; j < BeiList.Count; j++)
                {
                    if (BeiList[j] == id) 
                    {
                        flag = 1;
                        break;
                    }
                }
                if (flag == 1)
                {
                    Hlist.Add(Glist[i]);
                }

            }
            return Hlist;
        }
        //搜索关注他的人
        protected List<string> WhoGuanHe(string id) 
        {
            BLL.atbiao bll = new BLL.atbiao();
            List<string> Wlist = new List<string>();
            List<string> Ilist = bll.GetIdList();
            for (int i = 0; i < Ilist.Count; i++)
            {
                List<string> Glist = bll.GetGuanList(Ilist[i]);
                if (Glist == null)
                {
                    continue;
                }
                for (int j = 0; j < Glist.Count; j++)
                {
                    if (Glist[j] == id) {
                        Wlist.Add(Ilist[i]);
                        break;
                    }
                }
            }
            return Wlist;
        }
   
    }
}