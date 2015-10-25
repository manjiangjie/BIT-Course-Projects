using System;
using System.Data;
using System.Collections.Generic;
using Maticsoft.Common;
using Maticsoft.Model;
namespace Maticsoft.BLL
{
	/// <summary>
	/// atbiao
	/// </summary>
	public partial class atbiao
	{
		private readonly Maticsoft.DAL.atbiao dal=new Maticsoft.DAL.atbiao();
		public atbiao()
		{}
		#region  BasicMethod

		/// <summary>
		/// 得到最大ID
		/// </summary>
		public int GetMaxId()
		{
			return dal.GetMaxId();
		}

		/// <summary>
		/// 是否存在该记录
		/// </summary>
		public bool Exists(string id,int data_num)
		{
            return dal.Exists(id, data_num);
		}

		/// <summary>
		/// 增加一条数据
		/// </summary>
		public bool Add(Maticsoft.Model.atbiao model)
		{
			return dal.Add(model);
		}

		/// <summary>
		/// 更新一条数据
		/// </summary>
		public bool Update(Maticsoft.Model.atbiao model)
		{
			return dal.Update(model);
		}

		/// <summary>
		/// 删除一条数据
		/// </summary>
		public bool Delete(string id,int data_num)
		{
			
			return dal.Delete(id,data_num);
		}

		/// <summary>
		/// 得到一个对象实体
		/// </summary>
		public Maticsoft.Model.atbiao GetModel(string id,int data_num)
		{
			
			return dal.GetModel(id,data_num);
		}

		/// <summary>
		/// 得到一个对象实体，从缓存中
		/// </summary>
		public Maticsoft.Model.atbiao GetModelByCache(string id,int data_num)
		{
			
			string CacheKey = "atbiaoModel-" + id+data_num;
			object objModel = Maticsoft.Common.DataCache.GetCache(CacheKey);
			if (objModel == null)
			{
				try
				{
					objModel = dal.GetModel(id,data_num);
					if (objModel != null)
					{
						int ModelCache = Maticsoft.Common.ConfigHelper.GetConfigInt("ModelCache");
						Maticsoft.Common.DataCache.SetCache(CacheKey, objModel, DateTime.Now.AddMinutes(ModelCache), TimeSpan.Zero);
					}
				}
				catch{}
			}
			return (Maticsoft.Model.atbiao)objModel;
		}

		/// <summary>
		/// 获得数据列表
		/// </summary>
		public DataSet GetList(string strWhere)
		{
			return dal.GetList(strWhere);
		}
		/// <summary>
		/// 获得前几行数据
		/// </summary>
		public DataSet GetList(int Top,string strWhere,string filedOrder)
		{
			return dal.GetList(Top,strWhere,filedOrder);
		}
		/// <summary>
		/// 获得数据列表
		/// </summary>
		public List<Maticsoft.Model.atbiao> GetModelList(string strWhere)
		{
			DataSet ds = dal.GetList(strWhere);
			return DataTableToList(ds.Tables[0]);
		}
		/// <summary>
		/// 获得数据列表
		/// </summary>
		public List<Maticsoft.Model.atbiao> DataTableToList(DataTable dt)
		{
			List<Maticsoft.Model.atbiao> modelList = new List<Maticsoft.Model.atbiao>();
			int rowsCount = dt.Rows.Count;
			if (rowsCount > 0)
			{
				Maticsoft.Model.atbiao model;
				for (int n = 0; n < rowsCount; n++)
				{
					model = dal.DataRowToModel(dt.Rows[n]);
					if (model != null)
					{
						modelList.Add(model);
					}
				}
			}
			return modelList;
		}

		/// <summary>
		/// 获得数据列表
		/// </summary>
		public DataSet GetAllList()
		{
			return GetList("");
		}

		/// <summary>
		/// 分页获取数据列表
		/// </summary>
		public int GetRecordCount(string strWhere)
		{
			return dal.GetRecordCount(strWhere);
		}
		/// <summary>
		/// 分页获取数据列表
		/// </summary>
		public DataSet GetListByPage(string strWhere, string orderby, int startIndex, int endIndex)
		{
			return dal.GetListByPage( strWhere,  orderby,  startIndex,  endIndex);
		}
		/// <summary>
		/// 分页获取数据列表
		/// </summary>
		//public DataSet GetList(int PageSize,int PageIndex,string strWhere)
		//{
			//return dal.GetList(PageSize,PageIndex,strWhere);
		//}

        //获取某人的关注List
        public List<string> GetGuanList(string id) 
        {
            DataSet ds = dal.GetList("id = "+ "'"+id+ "'" + "order by data_num");
            DataTable dt = ds.Tables[0];
            string ids = "";
            foreach (DataRow dr in dt.Rows)   ///遍历所有的行
            { 
                ids += dr["ids"];
            }
            if (ids == "" || ids == null) 
            {
                return null;
            }
            string[] str = ids.Split(',');
            return new List<string>(str);
        }

        //获取所有人的id列表
        public List<string> GetIdList()
        {
            List<string> Ilist = new List<string>();
            DataSet ds = dal.GetAllId();
            DataTable dt = ds.Tables[0];
            foreach (DataRow dr in dt.Rows)   ///遍历所有的行
            {
                String id = dr["id"].ToString();
                Ilist.Add(id);
            }
            return Ilist;
        }

        //获取某人被关注的次数
        public int BeiNum(string id)
        {
            return dal.BeiNum(id);
        }

        //添加一条被关注记录
        public bool BeiRecord(string id, int num)
        {
            return dal.BeiRecord( id, num);
        }


        //修改一条被关注记录
        public bool UDBeiRecord(string id, int num)
        {
            return dal.UDBeiRecord(id, num);
        }

         
        //获取某人被关注的次数 巴松狼王
        public int BaNum(string id)
        {
            return dal.BaNum(id);
        }


        //添加一条被关注记录  巴松狼王
        public bool BaRecord(string id, int num)
        {
            return dal.BaRecord(id, num);
        }

        //修改一条被关注记录  巴松狼王
        public bool UDBaRecord(string id, int num)
        {
            return dal.UDBaRecord(id, num);
        }
		#endregion  BasicMethod
		#region  ExtensionMethod

		#endregion  ExtensionMethod
	}
}

