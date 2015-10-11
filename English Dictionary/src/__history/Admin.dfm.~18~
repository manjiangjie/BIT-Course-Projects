object AdminForm: TAdminForm
  Left = 0
  Top = 0
  Caption = #31649#29702#21592
  ClientHeight = 377
  ClientWidth = 645
  Color = clBtnFace
  Font.Charset = DEFAULT_CHARSET
  Font.Color = clWindowText
  Font.Height = -11
  Font.Name = 'Tahoma'
  Font.Style = []
  OldCreateOrder = False
  Position = poScreenCenter
  OnCloseQuery = FormCloseQuery
  PixelsPerInch = 96
  TextHeight = 13
  object POS: TLabel
    Left = 16
    Top = 136
    Width = 24
    Height = 13
    Caption = #35789#24615
  end
  object Word: TLabel
    Left = 16
    Top = 79
    Width = 24
    Height = 13
    Caption = #21333#35789
  end
  object Meaning: TLabel
    Left = 16
    Top = 195
    Width = 24
    Height = 13
    Caption = #37322#20041
  end
  object Example: TLabel
    Left = 16
    Top = 246
    Width = 24
    Height = 13
    Caption = #20363#21477
  end
  object ID: TLabel
    Left = 23
    Top = 27
    Width = 11
    Height = 13
    Caption = 'ID'
  end
  object Insert: TButton
    Left = 8
    Top = 296
    Width = 75
    Height = 25
    Caption = #28155#21152
    TabOrder = 0
    OnClick = InsertClick
  end
  object Update: TButton
    Left = 112
    Top = 296
    Width = 75
    Height = 25
    Caption = #20462#25913
    TabOrder = 1
    OnClick = UpdateClick
  end
  object Delete: TButton
    Left = 8
    Top = 344
    Width = 75
    Height = 25
    Caption = #21024#38500
    TabOrder = 2
    OnClick = DeleteClick
  end
  object Query: TButton
    Left = 112
    Top = 344
    Width = 75
    Height = 25
    Caption = #26597#35810
    TabOrder = 3
    OnClick = QueryClick
  end
  object Exit: TButton
    Left = 544
    Top = 344
    Width = 75
    Height = 25
    Caption = #36864#20986
    TabOrder = 4
    OnClick = ExitClick
  end
  object LogOff: TButton
    Left = 416
    Top = 344
    Width = 75
    Height = 25
    Caption = #27880#38144
    TabOrder = 5
    OnClick = LogOffClick
  end
  object InputWord: TEdit
    Left = 66
    Top = 76
    Width = 121
    Height = 21
    ParentShowHint = False
    ShowHint = True
    TabOrder = 6
    TextHint = #36755#20837#21333#35789
  end
  object InputPOS: TEdit
    Left = 66
    Top = 133
    Width = 121
    Height = 21
    TabOrder = 7
    TextHint = #36755#20837#35789#24615
  end
  object InputMeaning: TEdit
    Left = 66
    Top = 192
    Width = 121
    Height = 21
    TabOrder = 8
    TextHint = #36755#20837#37322#20041
  end
  object InputExample: TEdit
    Left = 66
    Top = 243
    Width = 121
    Height = 21
    TabOrder = 9
    TextHint = #36755#20837#20363#21477
  end
  object DBGrid1: TDBGrid
    Left = 208
    Top = 24
    Width = 429
    Height = 297
    DataSource = DataSource1
    TabOrder = 10
    TitleFont.Charset = DEFAULT_CHARSET
    TitleFont.Color = clWindowText
    TitleFont.Height = -11
    TitleFont.Name = 'Tahoma'
    TitleFont.Style = []
  end
  object InputID: TEdit
    Left = 66
    Top = 24
    Width = 121
    Height = 21
    TabOrder = 11
    TextHint = #36755#20837'ID'
  end
  object DataSource1: TDataSource
    DataSet = ADOQuery1
    Left = 296
    Top = 328
  end
  object ADOQuery1: TADOQuery
    Active = True
    Connection = ADOConnection1
    CursorType = ctStatic
    Parameters = <>
    SQL.Strings = (
      'select * from words')
    Left = 368
    Top = 328
  end
  object ADOConnection1: TADOConnection
    Connected = True
    ConnectionString = 
      'Provider=SQLOLEDB.1;Integrated Security=SSPI;Persist Security In' +
      'fo=False;Initial Catalog=Assignment3;Data Source=BIT-PC'
    LoginPrompt = False
    Provider = 'SQLOLEDB.1'
    Left = 224
    Top = 328
  end
end
